## Installation Laravel Project

Make sure composer and node.js are installed on your machine.

1. git clone repo <directory>
2. cd <directory>
3. npm install
4. composer install, Appserviceprovider all count variables in comments!
5. Copy .env.example to **.env** and put all necessary settings inside
   mail, database, ...
6. php artisan key:generate
7. Open project in editor and DELETE assets folder completely inside public folder if it exists (public/assets)
8. php artisan storage:link (setting storage link for images)
9. Start your wamp, mamp or xamp server
10. Create inside the server your databasename
11. php artisan migrate:fresh --seed
12. npm run dev
13. php artisan serve (then click on localhost) 
14. AppServiceprovider (activate all count variables again)
15. you must go to stripe and get these STRIPE_SECRET_KEY and STRIPE_WEBHOOK_SECRET and fill these in the env file
16. you must go to mailchimp and fill in these variables in the env file:
    VITE_PUSHER_APP_KEY=
    VITE_PUSHER_HOST=
    VITE_PUSHER_PORT=
    VITE_PUSHER_SCHEME=
    VITE_PUSHER_APP_CLUSTER=

##That's all folks, application is running


"# laravelblogklas2023" 
#   l a r a v e l b l o g k l a s 2 0 2 3 
 
 "# laravelblogklas2023" 
"# eindwerkmetbackend" 
