<?php
    include_once('config.php');

    if(empty($_POST['email']) || empty($_POST['password'])){
        header('Location: index.php');
        exit();
    }
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT id, email FROM users WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            die('Erro na consulta: ' . $conexao->error);
        }
    
        $row = $result->num_rows;
    
        if ($row == 1){
            header('Location: ecoPJ/index.html');
            exit();
        } else {   
            // retorno com JS
            echo "<script type='text/javascript'>".
                    "alert('Login inválido');".
                    "window.location.href = 'index.php'".
                "</script>";
        }
    } else {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }
    
    $stmt->close();
    $conexao->close();
?>