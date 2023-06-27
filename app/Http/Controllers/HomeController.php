<?php

namespace App\Http\Controllers;


use App\Models\Box;
use App\Models\Card;
use App\Models\Cart;
use App\Models\MonsterAttribute;
use App\Models\MonsterClass;
use App\Models\MonsterType;
use App\Models\Order;

use App\Models\SpellType;
use App\Models\TrapType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function index()
    {
        $spellTypes = SpellType::select('id')->get();
        $trapTypes = TrapType::select('id')->get();
        $monsterTypes = MonsterType::select('id')->get();
        $boxes = Box::query()->orderByDesc('created_at')->with('photo')->limit(6)->get();
        return view("home", compact("boxes","spellTypes","trapTypes","monsterTypes"));
    }

    public function shop(Request $request)
    {
        $boxes = Box::query()->orderByDesc('created_at')->with('photo')->paginate(12);
        $monsterClasses = MonsterClass::select('id', 'name')->get();
        $monsterTypes = MonsterType::select('id', 'name')->get();
        $monsterAttributes = MonsterAttribute::select('id', 'name')->get();
        $spellTypes = SpellType::select('id', 'name')->get();
        $trapTypes = TrapType::select('id', 'name')->get();
        $filterOptionMonsterType = $request->input('filter_monster_type');
        $filterOptionMonsterClass = $request->input('filter');
        $filterOptionMonsterAttribute = $request->input('filter_attribute');
        $filterOptionSpellType = $request->input('filter_spell');
        $filterOptionTrapType = $request->input('filter_trap');

        $cards = Card::query()
            ->when($filterOptionMonsterType, function ($query) use ($filterOptionMonsterType) {
                $query->where('monster_type_id', $filterOptionMonsterType);
            })
            ->when($filterOptionMonsterClass, function ($query)use($filterOptionMonsterClass){
                $query->whereIn('monster_class_id', $filterOptionMonsterClass);
            })
            ->when($filterOptionMonsterAttribute, function ($query)use($filterOptionMonsterAttribute){
                $query->where('monster_attribute_id', $filterOptionMonsterAttribute);
            })
            ->when($filterOptionSpellType, function ($query)use($filterOptionSpellType){
                $query->whereIn('spell_type_id', $filterOptionSpellType);
            })
            ->when($filterOptionTrapType, function ($query)use($filterOptionTrapType){
                $query->whereIn('trap_type_id', $filterOptionTrapType);
            })
            ->orderByDesc('created_at')
            ->with('photo')
            ->paginate(12);
        return view("shop", compact('boxes', 'cards', 'monsterTypes','monsterClasses','filterOptionMonsterType','filterOptionMonsterClass','filterOptionMonsterAttribute','monsterAttributes','spellTypes','trapTypes','filterOptionSpellType','filterOptionTrapType'));
    }

    public function filter(Request $request)
    {
        $monsterTypes = MonsterType::select('id', 'name')->get();
        $boxes = Box::query()->orderByDesc('created_at')->with('photo')->paginate(12);
        $filterOptionMonsterClass = $request->input('filter');
        $filterOptionPendulum = $request->input('filter_pendulum');

        $filterOptionMonsterSpecialType = $request->input('filter_monster_special_type');
        $filterOptionMonsterAttribute = $request->input('filter_attribute');
        $filterOptionMonsterLevel = $request->input('filter_level');
        $filterOptionAtkLow = [$request->input('filter_atk_low')];
        $filterOptionAtkHigh = [$request->input('filter_atk_high')];
        $filterOptionDefLow = [$request->input('filter_def_low')];
        $filterOptionDefHigh = [$request->input('filter_def_high')];


        //als de waarde null is moet hij op 0 staan omdat dit een boolean is
        if ($filterOptionPendulum === null) {
            $filterOptionPendulum = ["0"];
        }

    }

    public function shop_detail_card(Card $card)
    {
        return view("shop_detail_card", compact('card'));
    }

    public function shop_detail_box(Box $box)
    {
        return view("shop_detail_box", compact('box'));
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
                $order->session_id = $session->payment_intent;
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
                    $order->session_id = $session->payment_intent;
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
