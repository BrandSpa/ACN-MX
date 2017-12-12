<?php

    


     if( $_REQUEST['estado_datos'] == 'parcial' ){

     

          $my_post = array(
          'post_title'   => $_REQUEST['nombre'],
          'post_type'         => 'donaciones',
          'post_status'  => 'publish'
          );

         // $fecha = date('Ymd');

          // insert the post into the database

        

          $post_id = wp_insert_post( $my_post );


          update_field( 'nombre', $_REQUEST['nombre'], $post_id );
          update_field( 'correo', $_REQUEST['email'], $post_id );
          update_field( 'celular', $_REQUEST['celular'], $post_id );
          update_field( 'periodo', $_REQUEST['periodo'], $post_id );

          $to = $_REQUEST['correo_admin'];
          $subject = 'Nuevo registro parcial';
          $body = 'Datos del registro: <br>';
          $body .= 'Nombre: '. $_REQUEST['nombre'] .' <br>';
          $body .= 'Correo: '. $_REQUEST['email'] .' <br>';
          $body .= 'Celular: '. $_REQUEST['celular'] .' <br>';
          $body .= 'Periodo: '. $_REQUEST['periodo'] .' <br>';
          $headers = array('Content-Type: text/html; charset=UTF-8');
           
          wp_mail( $to, $subject, $body, $headers );


          //update_field( 'calle', $_REQUEST['calle'], $post_id );
          //update_field( 'estado', $_REQUEST['estado'], $post_id );
          //update_field( 'monto', $_REQUEST['mount'], $post_id );
          //update_field( 'numero', $_REQUEST['numero_calle'], $post_id );
          //update_field( 'colonia', $_REQUEST['colonia'], $post_id );
          //update_field( 'cp', $_REQUEST['cp'], $post_id );
          //update_field( 'municipio', $_REQUEST['municipio'], $post_id );
           echo $post_id;

       


     }
     else{

          $post_id = $_REQUEST['id_registro'];


          if($_REQUEST['para_validar'] == 'pagos'){


              

                update_field('metodo_pago', $_REQUEST['metodo_pago'], $post_id );

             


          }
          else{


               update_field('deducible', $_REQUEST['acepto'], $post_id );
               update_field( 'calle', $_REQUEST['calle'], $post_id );
               update_field( 'estado', $_REQUEST['estado'], $post_id );
               update_field( 'monto', $_REQUEST['mount'], $post_id );
               update_field( 'numero', $_REQUEST['numero_calle'], $post_id );
               update_field( 'colonia', $_REQUEST['colonia'], $post_id );
               update_field( 'cp', $_REQUEST['cp'], $post_id );
               update_field( 'municipio', $_REQUEST['municipio'], $post_id );
               update_field( 'metodo_pago', $_REQUEST['metodo_pago'], $post_id );

         


          }

           echo 'guardo';



     }
	 
	 die();

	


?>