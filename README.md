# BartnetAPI
php simple Back-End class

**Usage**

```
/*
Initialize
*/

$app = new App();
$params = $app->getParams();
$data = $app->getData();
 

/*
POST
*/
if ($app->post('/signin')) {
    //echo $data['user_id'];
    //echo $data['password'];
    // print result data
    $app->print(array(
        'user_id' => 'melong'.
        'name' => 'Hyuk-June'
    ));

/*
GET
*/
} else if ($app->get('/users/([a-zA-Z0-9_])')) {
    /* url: "/user_id/melong"
    //echo $params[0]; // melong
 
/*
PUT
*/
} else if ($app->put('/users/([a-zA-Z0-9])')) {
    //echo $data['user_id'];
    //echo $data['password'];
    //echo $params[0];
 
/*
PATCH
*/
} else if ($app->patch('/users/([a-zA-Z0-9])')) {
    //
 
/*
DELETE
*/
} else if($app->delete('/users/([a-zA-Z0-9])')) {
    //echo $params[0];
 
/*
multiple parameters
*/
} else if ($app->get('/article/([0-9])/([0-9])/edit')) {
    //echo $params[0];
    //echo $params[1];
}
```
