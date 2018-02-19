<?php

$app->post('/users/login', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();

//var_dump($data['users']['username']);die;
    
    
    //return $response->withJson( $request->getParsedBody() , 200);		
    
    try {
        $httpCode = 200;

        //check if the username already exist and return user details
        $selectStmt = $this->db->select()->from('users')->where('username','=',$data['username']);
        $objStmt = $selectStmt->execute();
        $arrResult = $objStmt->fetch();

        

        if (!$arrResult) {
            $arrResult = new stdClass();
            $httpCode = 404;
            //var_dump($arrResult, $httpCode);die;
        } 

        return $response->withJson( ['users' => $arrResult] , $httpCode);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});    


$app->post('/users', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();
    
    try {

        $data['created'] = date('Y-m-d H:i:s');

        $arrFields = array_keys($data);
        $arrValues = array_values($data);    
        
        // var_dump($arrFields);
        // var_dump($arrValues);

        // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
        $insertStatement = $this->db->insert( $arrFields )
                                    ->into('users')
                                    ->values($arrValues);
        $insertId = $insertStatement->execute(true);
                
        $strSelectStmt = $this->db->select()->from('users')->where('id','=',$insertId);
        $obj = $strSelectStmt->execute();
        $arrResult = $obj->fetch();           
        
        // var_dump($arrResult);
        // die;

        if (!$arrResult) $arrResult = new stdClass();

        return $response->withJson( ['users' => $arrResult] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});    