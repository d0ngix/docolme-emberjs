<?php

$app->get('/docus[/{id}]', function ( $request, $response, $args) {
    
        extract($args);
    
        try {

            if (isset($id)) {
                $strSelectStmt = $this->db->select()->from('docs')
                                                    //->join('histories','histories.doc_id','=','docs.id')
                                                    ->where('docs.id','=',$id);
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetch();             

                //retrieve histories
                $strSelectStmt = $this->db->select()->from('histories')
                                                    //->join('histories','histories.doc_id','=','docs.id')
                                                    ->where('histories.doc_id','=',$id);
                $objDocument = $strSelectStmt->execute();
                $arrResultHistories = $objDocument->fetchAll();                             

                if ( !empty($arrResultHistories) ) {
                    $arrResult['histories'] = $arrResultHistories;
                }

                if (!$arrResult) $arrResult = new stdClass();

            }  elseif ( !empty($request->getQueryParam('userId')) ) {

                $strSelectStmt = $this->db->select()->from('docs')->where('userId','=',$request->getQueryParam('userId') );
                $objDocument = $strSelectStmt->execute();
                $arrResult = $objDocument->fetchAll();              

                if (!$arrResult) $arrResult = new stdClass();

            } else {

                $strSelectStmt = $this->db->select()->from('docs');                
                $objDocument = $strSelectStmt->execute();
                $arrResultDoc = $objDocument->fetchAll();              

                //get the histories
                if (!empty($arrResultDoc)) {
                    $arrDocId = [];
                    array_walk($arrResultDoc, function ($v, $k) use (&$arrDocId) {
                           $arrDocId[] = $v['id'];
                    });                       
    
                    $strSelectStmt = $this->db->select()->from('histories')->whereIn('doc_id', $arrDocId);
                    $objDocument = $strSelectStmt->execute();
                    $arrResultHistory = $objDocument->fetchAll();                              

                    $arrNewResultHistory = [];
                    array_walk($arrResultHistory, function ($v, $k) use (&$arrNewResultHistory) {
                           $arrNewResultHistory[$v[ 'doc_id']][] = $v;
                    });                         
    
                    if (!empty ($arrResultDoc)) {
                        $arrNewResultDoc = [];
                        foreach($arrResultDoc as $v) {
                            $v['histories'] = $arrNewResultHistory[$v['id']];
                            $arrNewResultDoc[] = $v;
                        }
                        $arrResultDoc = $arrNewResultDoc;
                    }                    
                }

                $arrResult = $arrResultDoc;
                
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

        //get the username
        $strSelectStmt = $this->db->select(['username'])->from('users')->where('id','=',$data['docs']['userId']);
        $objDocument = $strSelectStmt->execute();
        $arrResultUser = $objDocument->fetch();            


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
        
        if ($arrResult) {
            //saving to hitories
            // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
            $insertStatement = $this->db->insert( ['doc_id','fileName','contentText','username','created','action'] )
                                        ->into('histories')
                                        ->values([$insertId,$data['docs']['fileName'],$data['docs']['contentText'],$arrResultUser['username'], $data['docs']['created'],'Created' ]);
            $insertId = $insertStatement->execute(true);        
        }

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

        if ($arrResult) {
            //get the username
            $strSelectStmt = $this->db->select(['username'])->from('users')->where('id','=',$data['docs']['userId']);
            $objDocument = $strSelectStmt->execute();
            $arrResultUser = $objDocument->fetch();             
            //saving to hitories
            // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
            //var_dump($data);die;
            $insertStatement = $this->db->insert( ['doc_id','fileName','contentText','username','created','action'] )
                                        ->into('histories')
                                        ->values([$id,$data['docs']['fileName'],$data['docs']['contentText'],$arrResultUser['username'], date('Y-m-d H:i:s'), 'Updated' ]);
            $insertId = $insertStatement->execute(true);                
        }

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