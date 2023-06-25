<?php

namespace App\Http\Controllers;


use App\Models\Box;
use App\Models\Card;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function index()
    {
        $boxes = Box::query()->orderByDesc('created_at')->with('photo')->limit(6)->get();
        $cards = Card::query()->orderByDesc('created_at')->with('photo')->limit(6)->get();
        return view("home", compact("boxes", "cards"));
    }

    public function shop()
    {
        return view("shop");
    }

    public function shop_detail()
    {
        return view("shop_detail");
    }

    public function order_received()
    {
        return view("order_received");
    }

    public function contact()
    {
        return view("contact");
    }

    public function checkout()
    {
        if (!Session::has('cart')) {
            return redirect('/');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;

            return view("checkout", compact('cart'));

        }
    }

    public function checkoutPay()
    {
        if (!Session::has('cart')) {
            return redirect('/');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            $totalPrice = 0;
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            foreach ($cart as $product) {
                $totalPrice += $product['product_price'];
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $product['product_name'],
                        ],
                        'unit_amount' => intval($product['product_price'] * 100),
                    ],
                    'quantity' => $product['quantity'],
                ];
            }
            $session = \Stripe\Checkout\Session::create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('checkout.cancel', [], true),
            ]);

            $order = new Order();
            $order->status = 'unpaid';
            $order->total_price = $totalPrice;
            $order->session_id = $session->id;
            $order->save();
            /*return view("checkout", compact('cart'));*/
            return redirect($session->url);
        }
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            if (auth()->user()) {
                $customer = auth()->user()->name;
            } else {
                $customer = $session->customer_details->email;
            }
            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

            return view('order_received', compact('customer'));

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }


    }

    public function cancel()
    {
        echo '<pre>';
        var_dump('order has not been placed');
        echo '</pre>';
    }

    public function webhook()
    {
        # This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');


        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            //invalid signature
            return response('', 400);
        }
        //handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $sessionId = $session->id;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    //send email to customer
                }

            // ... handle other event types
            default:
                echo 'Received unknow event type ' . $event->type;
        }
        return response('', 200);
    }

    public function cart()
    {
        if (!Session::has('cart')) {
            return redirect('/');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            return view("cart", compact('cart'));
        }
    }

    public function addToCart($id, $product_type)
    {
        $product = null;
        $productType = request()->product_type;
        $cartItemId = $productType . '_' . $id;

        if ($id) {
            if ($product_type === 'box') {
                $product = Box::with('photo')->where('id', $id)->first();
                $product->id = $cartItemId;
            } else {
                $product = Card::with('photo')->where('id', $id)->first();
                $product->id = $cartItemId;
            }
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $cartItemId);

        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function updateQuantity()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQuantity(request()->id, request()->quantity);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function updateQuantityBulk()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQuantityBulk(request()->items);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function removeItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return redirect()->back();
    }
}
