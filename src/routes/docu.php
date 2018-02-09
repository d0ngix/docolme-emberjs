<?php

$app->get('/docus[/{id}]', function ( $request, $response, $args) {
    
        extract($args);
    
        try {

            if (isset($id)) {
                $strSelectStmt = $this->db->select()->from('docs')->where('id','=',$id);
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetch();              

                if (!$arrResult) $arrResult = new stdClass();
                else {
                    $arrResult['isCompleted'] = (boolean)$arrResult['isCompleted'];
                }                      

            }  else {

                $strSelectStmt = $this->db->select()->from('docs');                
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetchAll();              

            }

      

    
            return $response->withJson( ['docs' => $arrResult] , 200);		
            
        } catch (Exception $e) {
            
            return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
            
        }
    
});

$app->post('/docus', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();
    
    //return $response->withJson( $request->getParsedBody() , 200);		
    
    try {

        $arrResult = new stdClass();

        if ( empty($data['docs']['created']) ) {
            $data['docs']['created'] = date('Y-m-d H:i:s');
        }

        $arrFields = array_keys($data['docs']);
        $arrValues = array_values($data['docs']);

        
           
        // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
        $insertStatement = $this->db->insert( $arrFields )
                                    ->into('docs')
                                    ->values($arrValues);
        $insertId = $insertStatement->execute(true);
                
        $strSelectStmt = $this->db->select()->from('docs')->where('id','=',$insertId);
        $objDocument = $strSelectStmt->execute();
        $arrResult = $objDocument->fetch();              

        if (!$arrResult) $arrResult = new stdClass();

        return $response->withJson( ['docs' => $arrResult] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});


$app->put('/docus/{id}', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();

    //return $response->withJson( $request->getParsedBody() , 200);		

    extract($args);
   
    try {

        $arrResult = new stdClass();
           
        // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
        $updateStatement = $this->db->update( ['fileName' => $data['docs']['fileName'] ] )
                                    ->set(['contentText' => $data['docs']['contentText']])
                                    ->table('docs')
                                    ->where('id', '=', $id);

        $arrResult = $updateStatement->execute(true);

        $data['docs']['id'] = $id;               

        return $response->withJson( ['docs' => $data['docs']] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});

$app->delete('/docus/{id}', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();

    extract($args);
   
    try {

        // DELETE FROM users WHERE id = ?
        $deleteStatement = $this->db->delete()
                                ->from('docs')
                                ->where('id', '=', $id);

        $affectedRows = $deleteStatement->execute();

        return $response->withJson( ['docs' => ['id'=>$id]] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});