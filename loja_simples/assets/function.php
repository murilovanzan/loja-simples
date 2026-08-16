<?php

    function isAdmin($pdo){

        if(isset($_SESSION['logado']) && $_SESSION['logado']){
            try{

                $sql = "SELECT * FROM user;";
                $stmt = $pdo->prepare($sql);

                $stmt->execute();

                $users = $stmt->fetchAll();
                foreach ($users as $user){
                    if($user['username'] == 'admin' && $_SESSION['ID_login'] == $user['ID']){
                        return true;
                    }
                }

            }
            catch(PDOException $e){
                echo "Erro ao verificar ADM - " . $e->getMessage();
            }
        }
        
        return false;
    }

?>