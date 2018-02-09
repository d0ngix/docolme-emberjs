<?php

$app->get('/tasks[/{id}]', function ( $request, $response, $args) {
    
        extract($args);
    
        try {
    
            

            if (isset($id)) {
                $strSelectStmt = $this->db->select()->from('todos')->where('id','=',$id);
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetch();              

                if (!$arrResult) $arrResult = new stdClass();
                else {
                    $arrResult['isCompleted'] = (boolean)$arrResult['isCompleted'];
                }                      

            }  else {

                $strSelectStmt = $this->db->select()->from('todos');                
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetchAll();              

            }

      

    
            return $response->withJson( ['todos' => $arrResult] , 200);		
            
        } catch (Exception $e) {
            
            return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
            
        }
    
});

$app->post('/tasks', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();
    
    //return $response->withJson( $request->getParsedBody() , 200);		
    
    try {

        $arrResult = new stdClass();

        $arrFields = array_keys($data['todo']);
        $arrValues = array_values($data['todo']);

        // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
        $insertStatement = $this->db->insert( $arrFields )
                                    ->into('todos')
                                    ->values($arrValues);
        $insertId = $insertStatement->execute(true);
                
        $strSelectStmt = $this->db->select()->from('todos')->where('id','=',$insertId);
        $objDocument = $strSelectStmt->execute();
        $arrResult = $objDocument->fetch();              

        if (!$arrResult) $arrResult = new stdClass();
        else {
            $arrResult['isCompleted'] = (boolean)$arrResult['isCompleted'];
        }

        return $response->withJson( ['todos' => $arrResult] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});


$app->put('/tasks/{id}', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();

    extract($args);
   
    try {

        $arrResult = new stdClass();
           
        // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
        $updateStatement = $this->db->update($data['todo'])
                                    ->table('todos')
                                    ->where('id', '=', $id);

        $arrResult = $updateStatement->execute(true);

        $data['todo']['id'] = $id;               
        $data['todo']['isCompleted'] = (boolean) $data['todo']['isCompleted'];

        return $response->withJson( ['todos' => $data['todo']] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});

$app->delete('/tasks/{id}', function ( $request, $response, $args) {
    
    $data = $request->getParsedBody();

    extract($args);
   
    try {

        // DELETE FROM users WHERE id = ?
        $deleteStatement = $this->db->delete()
                                ->from('todos')
                                ->where('id', '=', $id);

        $affectedRows = $deleteStatement->execute();

        return $response->withJson( ['todos' => ['id'=>$id]] , 200);		
        
    } catch (Exception $e) {
        
        return $response->withJson(array("status" => false, "message" => $e->getMessage()), 200);
        
    }

});

