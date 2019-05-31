# yoti

This repo provides the solution for the Yoti SDK Back-end test.

## setup
Run the following commands so you can be up and running in no time:

```
php bin/console doctrine:database:create
```

```
php bin/console make:migration
```

```
php bin/console doctrine:migrations:migrate
```

Start the server:
```
php bin/console server:start
```

Open a RestAPI application such as `Postman` and use this route(or the appropriate localhost and port number as you see in your terminal):
```
http://127.0.0.1:8000/
```
In Postman select the `body` tab  and click `form-data`. Create a key called `json` and place the sample data as `value`.

Sample data:
```
{ "roomSize" : [5, 5], "coords" : [0, 0], "patches" : [ [1, 0], [2, 2], [2, 3] ], "instructions" : "EN" }
```

Send the request!
