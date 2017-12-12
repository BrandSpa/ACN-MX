<?php
	/*
	Element Description: VC Info Box
	*/
	 
	// Element Class 
	class vcInfoBox extends WPBakeryShortCode {
	     
	    // Element Init
	    function __construct() {
	        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
	        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
	    }
	     
	    // Element Mapping
	    public function vc_infobox_mapping() {
	         
	        // Stop all if VC is not enabled
	        if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	        }
	         
	        // Map the block with vc_map()
	        vc_map( 
	            array(
	                'name' => __('Donaciones', 'text-domain'),
	                'base' => 'vc_infobox',
	                'description' => __('Modulo de donaciones', 'text-domain'), 
	                'category' => __('My Custom Elements', 'text-domain'),   
	                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
	                'params' => array(  

	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase donacion', 'text-domain' ),
	                        'param_name' => 'frase1',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ), 

	                     array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase otro medio de pago', 'text-domain' ),
	                        'param_name' => 'frase2',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ), 
						

	                     array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase Gracias 1 no donador', 'text-domain' ),
	                        'param_name' => 'frase3',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ),
						

	                     array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase Gracias 2 no donador', 'text-domain' ),
	                        'param_name' => 'frase4',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ),
						
						array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase Gracias 1 donador', 'text-domain' ),
	                        'param_name' => 'frase5',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ),
						
						array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Frase Gracias 2 donador', 'text-domain' ),
	                        'param_name' => 'frase6',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Frases',
	                    ),
	                         
	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Monto', 'text-domain' ),
	                        'param_name' => 'title',
	                        'value' => __( 'Donaciones', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 1',
	                    ),  

	                    array(
	                        'type' => 'textarea',
	                        'holder' => 'div',
	                        'class' => 'text-class',
	                        'heading' => __( 'Text', 'text-domain' ),
	                        'param_name' => 'text',
	                        'value' => __( 'Descricpion', 'text-domain' ),
	                        'description' => __( 'Informacion', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 1',
	                    ),  

	                    array(
						  "type" => "attach_image",
						  "class" => "",
						  "heading" => __( "Imagen", "my-text-domain" ),
						  "param_name" => "imagen1",
						  "value" => '',
						  'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 1',
						),
						
						array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Monto', 'text-domain' ),
	                        'param_name' => 'title2',
	                        'value' => __( 'Donaciones', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 2',
	                    ),  

	                    array(
	                        'type' => 'textarea',
	                        'holder' => 'div',
	                        'class' => 'text-class',
	                        'heading' => __( 'Text', 'text-domain' ),
	                        'param_name' => 'text2',
	                        'value' => __( 'Descricpion', 'text-domain' ),
	                        'description' => __( 'Informacion', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 2',
	                    ),  

	                    array(
						  "type" => "attach_image",
						  "class" => "",
						  "heading" => __( "Imagen", "my-text-domain" ),
						  "param_name" => "imagen2",
						  "value" => '',
						  'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 2',
						),
						
						array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Monto', 'text-domain' ),
	                        'param_name' => 'title3',
	                        'value' => __( 'Donaciones', 'text-domain' ),
	                        'description' => __( 'Box Title', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 3',
	                    ),  

	                    array(
	                        'type' => 'textarea',
	                        'holder' => 'div',
	                        'class' => 'text-class',
	                        'heading' => __( 'Text', 'text-domain' ),
	                        'param_name' => 'text3',
	                        'value' => __( 'Descricpion', 'text-domain' ),
	                        'description' => __( 'Informacion', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 3',
	                    ),  

	                    array(
						  "type" => "attach_image",
						  "class" => "",
						  "heading" => __( "Imagen", "my-text-domain" ),
						  "param_name" => "imagen3",
						  "value" => '',
						  'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Monto 3',
						),

	                    array(
	                        'type' => 'textarea',
	                        'holder' => 'div',
	                        'class' => 'text-class',
	                        'heading' => __( 'Text', 'text-domain' ),
	                        'param_name' => 'text4',
	                        'value' => __( 'Descricpion', 'text-domain' ),
	                        'description' => __( 'Informacion', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Otro',
	                    ),  

	                    array(
						  "type" => "attach_image",
						  "class" => "",
						  "heading" => __( "Imagen", "my-text-domain" ),
						  "param_name" => "imagen4",
						  "value" => '',
						  'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Otro',
						),

	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Correo', 'text-domain' ),
	                        'param_name' => 'correo',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Ingresa el correo para las notificaciones', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Admin',
	                    ),

	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Url', 'text-domain' ),
	                        'param_name' => 'url',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( 'Ingresa la url de redireccion despues de llenar los formularios', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Admin',
	                    ) 

	                                       
	                        
	                ),
	            )
	        );                                
	        
	    }
	     
	     
	    // Element HTML
	    public function vc_infobox_html( $atts ) {
	         
	        // Params extraction
	        extract(
	            shortcode_atts(
	                array(
	                    'title'   => '',
	                    'text' => '',
						'imagen1' => '',
						'title2'   => '',
	                    'text2' => '',
						'imagen2' => '',
						'title3'   => '',
	                    'text3' => '',
						'imagen3' => '',
	                    'text4' => '',
						'imagen4' => '',
	                    'frase1' => '',
	                    'frase2' => '',
						'frase3' => '',
						'frase4' => '',
						'frase5' => '',
						'frase6' => '',
	                    'correo' => '',
	                    'url' => ''
	                ), 
	                $atts
	            )
	        );

	       

	         
	         // Fill $html var with data
	        $html = "
	        <style>
	            @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700');
	            @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css');

	            .box_donaciones{

	                width:'100%;
	                  font-family: 'Source Sans Pro', sans-serif !important;
	                  -webkit-font-smoothing: antialiased;
	                  -moz-osx-font-smoothing: grayscale;
	                  position:relative;
	            }

	            .botones{
	               width:'100%';
	            }

	            .botones .btn_don{
	                width:50%;
	                float:left;
	                heighT:40px;
	                display:block;
	                text-align:center;
	                color:#4A4A4A;
	                font-size:18px;
	                font-family: 'Source Sans Pro', sans-serif;
	                 line-height:40px;
	                 background:#fff;
	                 cursor:pointer;


	            }

	            .botones .btn_don.active, .botones .btn_don:hover{
	               background:#EC232F;
	                text-align:center;
	                color:#fff;
	                font-size:18px;
	              
	                text-decoration:none;

	                

	            }

	            .info_donacion .img{
	                width:30%;
	                float:left;
	            }

	            .info_main{
	                width:70%;
	                float:left;
	                padding:15px 20px;
	                font-size:16px;
	                color:#fff;
	                font-wight:400;
	            }

	            .info_donacion .img img{
	                width:100%;

	            }

	             .info_donacion{
	                background:#4A4A4A;

	             }

	            .clr{
	                clear:both;
	            }

	            .box_values{
	                padding:15px;
	                background:#fff;
	                font-size:18px;
	            }

	            .box_values ul{
	                list-style:none;
	                margin:0px;
	                padding:0px;
	            }

	            .box_values ul li{
	                display:block;
	                float:left;
	                width:25%;
	                border:1px solid #CDCDCD;
	                border-left:none;
	                text-align:center;
	            }

	            .box_values ul li:first-child{
	                border-left:1px solid #CDCDCD;
	            }

	            .box_values ul li a{
	                display:block;
	                padding:10px;
	                color:#4A4A4A;
	            }

	             .box_values ul li a.active, .box_values ul li a:hover{
	                background:#EC232F;
	                color:#fff;
	                text-decoration:none;
	                cursor:pointer;
	             }

	             .text-box{
	                padding:10px 0;
	                text-align:center;
	                color:#4A4A4A;
	             }

	             .valor{
	                padding:10px;
	                color:#4A4A4A;
	                font-size:18px;
	                width:100%;
	                background:none;
	                border:1px solid #CDCDCD;
	             }

	             .valor .form-input{
	                color:#4A4A4A;
	                display:inline-block;
	                background:none;
	                padding:0px;
	                width:auto;
	                height:auto;
	                line-height:normal;
	                box-shadow:none;

	             }

	             input:focus{
	                ouline:none !important;
	                box-shadow:none;
	            }

	             .btn_send{
	                width:100%;
	                padding:10px;
	                background:#f3da4b;
	                font-size:24px;
	                text-transform:uppercase;
	                margin-top:15px;
	                width:100%;
	                color:#000;
	                display:block;
	                text-align:center;
	                cursor:pointer;
	                margin-bottom:10px;

	             }

	              .btn_send:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#000;

	              }

	              .btn_send2{
	               
	                padding:10px;
	                background:#EC232F;
	                font-size:24px;
	                text-transform:uppercase;
	                margin-top:15px;
	                
	                color:#fff;
	                display:block;
	                text-align:center;
	                cursor:pointer;
	               
	                position:absolute;
	                bottom: 10px;
	                left: 10px;
	                right: 10px;

	             }
				 
				 .btn_otros {
					padding: 10px 20px;
					background: #4A4A4A;
					font-size: 14px;
					text-transform: uppercase;
					margin-top: 0px;
					color: #fff;
				
					text-align: center;
					cursor: pointer;
					width: auto;
					display: inline-block;
				}
				 
				  .btn_otros:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#000;

	              }

	              .btn_send3{
	                padding:10px;
	                background:#EC232F;
	                font-size:24px;
	                text-transform:uppercase;
	                margin-top:15px;
	                
	                color:#fff;
	                display:block;
	                text-align:center;
	                cursor:pointer;
	               
	                
	                bottom: 10px;
	                left: 10px;
	                right: 10px;

	             }

	              .btn_send2:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#000;

	              }

	               .btn_send3:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#000;

	              }


	              .seguridad{
	                font-size:11px;
	                color:#1B1B1B;
	                text-align:right;
	              }

	              .seguridad .sec{
	                color:#59915E;
	                font-size:13px;
	                text-align:left;
	              }

	              .seguridad .sec2{
	                color:#59915E;
	                font-size:13px;
	                text-align:right;
	              }

	              .seguridad img{
	                margin-right:4px;
	              }

	              table td, table{
	                margin:0px;
	                padding:0px;
	                border:none;
	              }

	              .page-donaciones{
	                display:none;
	                background:#fff;
	                animation-duration: 0.2s;

	              }

	               .donaciones-page1{
	                display:block;

	              }

	              .mensaje{
	                display:none;
	                padding:5px 0;
	                color:#d0021b;
	              }

	              .mensaje2{
	                display:none;
	                padding:5px 0;
	                color:#d0021b;
	              }

	              .mensaje3{
	                display:none;
	                padding:5px 0;
	                color:#d0021b;
	              }

	              .mensaje4{
	                display:none;
	                padding:5px 0;
	                color:#d0021b;
	              }

	              .top_donaciones{
	                background:#ECECEC;
	                padding:10px;
	              }

	              .volver{
	                cursor:pointer;
	              }

	              .main_donaciones{
	                padding:15px;
	                min-height: 400px;
	                position:relative;
	                font-size:16px;
	                color:#4A4A4A;
	              }

	              .main_donaciones h2{
	                font-size:20px;
	                color:#4A4A4A;
	                text-align:center;
	                line-height:20px;
	                margin-bottom:15px;
	              }

	              .campo-field{
	                padding:10px 0;
	                border-top:1px solid #D0D0D0;
	              }

	              .campo-field.last{
	                border-bottom:1px solid #D0D0D0;
	              }

	              .campo-field img{
	                margin-right:4px;
	              }

	              .campo-field input{

	                width:100%;
	                height:35px;
	              }

	              select.month{
	                width:47%;
	                margin-right:2%;
	                height:35px;
	              }

	              select.year{
	                width:49%;
	                height:35px;
	              }


	              .alerta{

	                position: absolute;
	                height: 100%;
	                background: rgba(255,255,255,0.9);
	                display: none;
	                width: 100%;
	                top: 0px;
	                bottom: 0px;



	              }

	              .info_alerta{

	                    position: absolute;
	                    top: 50%;
	                    transform: translate(0%, -50%);
	                    text-align: center;
	                    color: #fff;
	                    display: block;
	                    width: 100%;
	                    font-size:14px;
	                    color:#1B1B1B;
	                    text-transform:uppercase;

	              }

	              .info_alerta span{
	                font-size:20px;
	                text-transform:none;
	            }


	            .info_alerta .sec{
	                color:#59915E;
	                font-size:13px;
	                font-wight:700;
	               
	              }

	              .info_alerta .sec img{
	                margin-right:4px;
	              }

	              .donaciones-page4.page-donaciones{
	                background:none;
	              }

	              .donaciones-page4.page-donaciones h3{

	                    font-size:40px;
	                    color:#F0AC3D;
	                    text-transform: uppercase;
	                    font-weight: bold;
	                    margin-bottom:5px;
	                   line-height: 29px;

	              }

	              .donaciones-page4.page-donaciones{
	                    font-size:20px;
	                    color:#fff;
	                    font-weight: bold;
	                    line-height:23px;

	              }

	              .donaciones-page4.page-donaciones .campo-field{
	                border:0px;
	                    height: 50px;
	              }

	              .form_final{
	                background:#fff;
	                padding:15px;
	                font-size:16px;
	                color:#ddd;
	                color:#4A4A4A;
	                font-weight:normal;
	                margin-top:0px;
	              }

	              .form_final strong{
	                    color: #36AD6A;
	                    font-size: 20px;
	                    margin-bottom: 10px;
	                    text-align: center;
	                    width: 100%;
	                    display: block;
	            }

	            .form_final span.verde{
	                    color: #36AD6A;
	                    font-size: 17x;
	                    margin-bottom: 10px;
	                    text-align: center;
	                    width: 100%;
	                    display: block;
	            }

	            .form_final span.gris{
	                    
	                    font-size: 17x;
	                    margin-bottom: 10px;
	                    text-align: center;
	                    width: 100%;
	                    display: block;
	            }

	            .form_final td{
	                padding:10px;
	            }


	            .btn_send4:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#36AD6A;

	              }

	              .btn_send4{
	               
	                padding:10px;
	                background:#36AD6A;
	                font-size:20px;
	                text-transform:uppercase;
	                margin-top:10px;
	                margin-bottom:10px; 
	                color:#fff;
	                display:block;
	                text-align:center;
	                cursor:pointer;
	                width:100%;
	               
	                
	               

	             }

	             .btn_send5:hover{
	                text-decoration:none;
	                color:#fff !important;
	                background:#36AD6A;

	              }

	              .btn_send5{
	               
	                padding:10px;
	                background:#36AD6A;
	                font-size:24px;
	                text-transform:uppercase;
	                margin-top:15px;
	                
	                color:#fff;
	                display:block;
	                text-align:center;
	                cursor:pointer;
	               
	                position:relative;

	            }

	             .copy{
	                font-size:11px;
	             }

	             .name_donador{

	                display: inline;
	             }
				 
				 .donaciones-page3.page-donaciones .main_donaciones{
					  min-height: 500px;
				 }

	             .campo-field input.acepto{
	                width: auto;
	                display: inline-block;
	                height: auto;
	             }

	              

	        </style>

	        <script>
	!function(t,e,n,s) { t.DPEventsFunction=s,t[s]=t[s] || function() { (t[s].q=t[s].q||[]).push(arguments) }; var c=e.createElement('script'),o=e.getElementsByTagName('script')[0]; c.async=1,c.src=n,o.parentNode.insertBefore(c,o); }(window, document, 'https://www.convertloop.co/v1/loop.min.js', '_dp');

	_dp('configure', { appId: 'c2a29177', autoTrack: true });
	_dp('pageView');
	</script>

	        <script>
	            
	            function analyticsEvent(metodo, periodo, monto){
	               
	                var tag = '',
	                    action = '',
	                    eventLabel = '';

	                if(periodo == 'mensual') {
	                    action = 'DONATION_MONTHLY'; 
	                }else{
	                    action = 'DONATION_UNIQUE';
	                }

	                if(metodo == 'payu') {
	                    tag = 'DONATION_PAYU';
	                }else{ 

	                    tag = 'DONATION_OTROSMEDIOS';

	                    if(metodo == 'oxxo'){
	                        action = 'DONATION_OXXO';
	                    }else{
	                        action = 'DONATION_BANK';
	                    }
	                }

	                if ('__gaTracker' in window) {

	                    __gaTracker('send', 'event', 'DONATION', action, tag, monto);
	                    
	                }

	            }
	            
	            function FB_Events ( _value ) {
	                fbq('track', 'Purchase', {'value': _value ,'currency':'MXN'});
	            }

	            jQuery( document ).ready(function() {

	               function isNumberKey(evt)
	                  {
	                     var charCode = (evt.which) ? evt.which : event.keyCode
	                     if (charCode > 31 && (charCode < 48 || charCode > 57))
	                        return false;

	                     return true;
	                  }

	                jQuery.fn.extend({
	                    animateCss: function (animationName) {
	                        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
	                        this.addClass('animated ' + animationName).one(animationEnd, function() {
	                            jQuery(this).removeClass('animated ' + animationName);
	                        });
	                        return this;
	                    }
	                });

	                jQuery( '.btn_don' ).click(function() {

	                      jQuery('.btn_don').removeClass('active');
	                      jQuery(this).addClass('active');
	                      jQuery('.mensaje').hide();

	                });

	                jQuery('.btn_send').click(function() {

	                    var valor = jQuery('.monto-number').val();

	                    if(valor == '' || parseInt(valor) < 53){

	                        jQuery('.mensaje').show().html('El monto mínimo es de 53');

	                    }
	                    else{


	                        jQuery('.mont_1').html(valor);

	                        if(jQuery('.btn_don.active').attr('data-name') == 'mensual'){

	                             jQuery('.mont_2').html('mensuales');
	                             jQuery('.periodo').val('mensual');

	                        }
	                        else{

	                             jQuery('.periodo').val('una sola vez');
	                             jQuery('.mont_2').html('una sola vez');

	                        }

	                       

	                        jQuery('.donaciones-page1').animateCss('fadeOut');

	                        jQuery('.donaciones-page1').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                            jQuery(this).hide();
	                            jQuery('.donaciones-page2').show().animateCss('fadeIn');
	                        });


	                    }

	                });


	                jQuery('.btn_send2').click(function() {


	                    if(jQuery('.nombre').val() == ''){
	                         jQuery('.mensaje2').show().html('Debes ingresar tu nombre');
	                         return;
	                    }
	                    if(jQuery('.email').val() == ''){
	                         jQuery('.mensaje2').show().html('Debes ingresar tu email');
	                         return;
	                    }
						 if(jQuery('.email').val().indexOf('@', 0) == -1 || jQuery('.email').val().indexOf('.', 0) == -1) {  
							jQuery('.mensaje2').show().html('La dirección de e-mail es incorrecta');  
							return;  
						}  
						
	                    
	                    
	                    var monto = jQuery('.monto-number').val();
	                    jQuery('.btn_send3').html('Donar MX$'+ monto );


	                    jQuery('.alerta').show();

	                    jQuery('.alerta .info_alerta').find('span').html('Un momento por favor, estamos procesando tu solicitud.')

	                    jQuery.ajax({

	                        type: 'post',
	                        url: '/save',
	                   
	                        data: jQuery('form').serialize(),
	                        success: function (data) {
	                               
	                                jQuery('.alerta').hide();

	                                jQuery('.alerta .info_alerta').find('span').html('Estamos procesando tu donación,');

	                                 _dp('track', 'mx_prosp_donate_vt', {
	                                      person: {
	                                        email: jQuery('.email').val(),
	                                        user_id: data,
	                                        pid: '8t16f883',
											first_name: jQuery('.nombre').val(),
											type: jQuery('.metodo_pago').val() + ' - ' + jQuery('.periodo')
	                                      },
										  metadata: {
											amount: jQuery('.monto-number').val()
										  }
	                                });

	                                jQuery('.id_registro').val(data);
	                                jQuery('.estado_datos').val('final');

	                                jQuery('.donaciones-page2').animateCss('fadeOut');

	                                jQuery('.donaciones-page2').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                                     jQuery(this).hide();
	                                     jQuery('.donaciones-page3').show().animateCss('fadeIn');
	                                 });
	                        }
	                   });
	                });

	                jQuery('.btn_send3').click(function() {


	                    if(jQuery('.tarjeta').val() == ''){
	                         jQuery('.mensaje3').show().html('Debes ingresar el numero de la tarjeta');
	                         return;
	                    }
	                    if(jQuery('.cvc').val() == ''){
	                         jQuery('.mensaje3').show().html('Debes ingresar  el codigo de seguridad.');
	                         return;
	                    }


	                    jQuery('.alerta').show();


	                    jQuery.ajax({

	                        type: 'post',
	                        url: '/pay.php',
	                   
	                        data: jQuery('form').serialize(),
	                        success: function (data) {

	                           jQuery('.alerta').hide();

	                           jQuery('.mensaje3').show().html('La transacción fue declinada, vuelve a intentar con otros datos <br>' );
	                          
	                           var datos = JSON.parse(data);

	                           if(datos['transactionResponse']['state'] == 'APPROVED'){

	                                    _dp('track', 'mx_donate_vt_credit', {
	                                         person: {
												email: jQuery('.email').val(),
												user_id: data,
												pid: '8t16f883',
												first_name: jQuery('.nombre').val(),
												type: jQuery('.metodo_pago').val() + ' - ' + jQuery('.periodo')
											  },
											  metadata: {
												amount: jQuery('.monto-number').val()
											  }
	                                    });
	                                
	                                    var monto = jQuery('.monto-number').val(),
	                                        metodo = jQuery('.metodo_pago').val(),
	                                        periodo = jQuery('.periodo').val(); 
	                                     jQuery('.donacion_monto').html(monto);
	                                    
	                                    FB_Events(monto);
	                                    analyticsEvent(metodo, periodo, monto);

	                                     var nombre = jQuery('.nombre').val();
	                                     jQuery('.name_donador').html(nombre);

	                                     jQuery('.donaciones-page3').animateCss('fadeOut');

	                                    jQuery('.donaciones-page3').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                                             jQuery(this).hide();
	                                             jQuery('.donaciones-page4').show().animateCss('fadeIn');
	                                             jQuery('.volver4').hide();

	                                             jQuery('.form_final strong').html(' ". $frase5 ."');
	                                             jQuery('.form_final span.gris').html(' ". $frase6 ."');

	        
	                                             
	                                       });
	                                
	                           }

	                        }

	                        
	                   });

	                   

	                });



	                jQuery('.btn_send4').click(function() {


	                    if(jQuery('.calle').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar la calle');
	                         return;
	                    }
	                    if(jQuery('.numero_calle').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar  numero de la calle.');
	                         return;
	                    }

	                    if(jQuery('.numero_calle').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar  numero de la calle.');
	                         return;
	                    }

	                     if(jQuery('.colonia').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar la colonia');
	                         return;
	                    }

	                    if(jQuery('.cp').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar el cp');
	                         return;
	                    }

	                    if(jQuery('.municipio').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar el municipio');
	                         return;
	                    }

	                    if(jQuery('.estado').val() == ''){
	                         jQuery('.mensaje4').show().html('Debes ingresar el estado');
	                         return;
	                    }


	                    jQuery('.alerta').show();
	                    jQuery('.alerta .info_alerta').find('span').html('Un momento por favor, estamos procesando tu solicitud.')

	                    jQuery.ajax({

	                        type: 'post',
	                        url: '/save',
	                   
	                        data: jQuery('form').serialize(),
	                        success: function (data) {
	                            //console.log('store 2');
	                            jQuery('.alerta').hide();
	                            jQuery('.alerta .info_alerta').find('span').html('Estamos procesando tu donación,');
	                          
	                          

	                           if(data== 'guardo'){
	                            var monto = jQuery('.monto-number').val(),
	                                metodo = jQuery('.metodo_pago').val(),
	                                periodo = jQuery('.periodo').val(); 
	                            analyticsEvent(metodo, periodo, monto);
	                            FB_Events(monto);
	                                
	                                //jQuery('.form_final table').hide();
	                                //jQuery('.form_final strong').html('Los datos fueron guardados satisfactoriamente');
	                                window.location.replace('". $url ."');

	                           }
	                           else{


	                            jQuery('.mensaje4').show().html('Se presentaron algunos errores');


	                           }

	                        }
	                   });

	                   

	                });


	                 jQuery('.btn_send5').click(function() {

	                     var pago = jQuery('input[name=tipo_pago]:checked').val();

	                     jQuery('.metodo_pago').val(pago);

	                     jQuery('.para_validar').val('pagos');

	                     jQuery('.alerta').show();
	                    jQuery('.alerta .info_alerta').find('span').html('Un momento por favor, estamos procesando tu solicitud.')


	                     jQuery.ajax({

	                        type: 'post',
	                        url: '/save',
	                   
	                        data: jQuery('form').serialize(),
	                        success: function (data) {
	                            //console.log('store 3');

	                        var monto = jQuery('.monto-number').val(),
		                            metodo = jQuery('.metodo_pago').val(),
		                            periodo = jQuery('.periodo').val(); 
		                        analyticsEvent(metodo, periodo, monto);
		                        FB_Events(monto);
	                          jQuery('.alerta').hide();
	                          jQuery('.alerta .info_alerta').find('span').html('Estamos procesando tu donación,');
	                          
	                          jQuery('.donaciones-page5').animateCss('fadeOut');

	                               jQuery('.donaciones-page5').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function()                                                                 {
	                                     jQuery(this).hide();
	                                     jQuery('.donaciones-page4').show().animateCss('fadeIn');
	                            });

	                             jQuery('.para_validar').val('normal');

	                           



	                        }
	                   });

	                 });

	                jQuery('.volver1').click(function() {
						
						 jQuery('.mensaje, .mensaje2, .mensaje3, .mensaje4').hide();

	                      jQuery('.donaciones-page2').animateCss('fadeOut');

	                        jQuery('.donaciones-page2').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                            jQuery(this).hide();
	                            jQuery('.donaciones-page1').show().animateCss('fadeIn');
	                     });

	                 });
					 
					 jQuery('.btn_otros').click(function() {
						 
						 //jQuery('.monto-number').val('0');

	                     jQuery('.donaciones-page3').animateCss('fadeOut');

	                       jQuery('.donaciones-page3').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() 							                                      {
	                             jQuery(this).hide();
	                             jQuery('.donaciones-page5').show().animateCss('fadeIn');
	                       });

	                 });

	                 jQuery('.volver2').click(function() {
						 
						  jQuery('.mensaje, .mensaje2, .mensaje3, .mensaje4').hide();

	                      jQuery('.donaciones-page3').animateCss('fadeOut');

	                        jQuery('.donaciones-page3').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                            jQuery(this).hide();
	                            jQuery('.donaciones-page2').show().animateCss('fadeIn');
	                     });

	                 });

	                jQuery('.volver3').click(function() {
	                     
	                      jQuery('.mensaje, .mensaje2, .mensaje3, .mensaje4').hide();

	                      jQuery('.donaciones-page5').animateCss('fadeOut');

	                        jQuery('.donaciones-page5').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                            jQuery(this).hide();
	                            jQuery('.donaciones-page3').show().animateCss('fadeIn');
	                     });

	                 });

	                jQuery('.volver4').click(function() {
	                                     
	                      jQuery('.mensaje, .mensaje2, .mensaje3, .mensaje4').hide();

	                      jQuery('.donaciones-page4').animateCss('fadeOut');

	                        jQuery('.donaciones-page4').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
	                            jQuery(this).hide();
	                            jQuery('.donaciones-page5').show().animateCss('fadeIn');
	                     });

	                 });

	                jQuery( '.box_values ul li a' ).click(function() {

	                      jQuery('.mensaje, .mensaje2, .mensaje3, .mensaje4').hide();

	                      jQuery('.box_values ul li a').removeClass('active');
	                      jQuery(this).addClass('active');

	                      var valor = jQuery(this).attr('data-mount');
						  var desc = jQuery(this).attr('data-desc');
						  var image = jQuery(this).attr('data-image');
						  
						 jQuery('.info_donacion img').attr('src', image );
						 jQuery('.info_donacion .info_main').html( desc );

	                      if (valor == 'otro'){
	                        jQuery('.monto-number').attr('readonly', false);
	                        jQuery('.monto-number').val('');
	                      }
	                      else{
	                         jQuery('.monto-number').val(valor);
	                         jQuery('.monto-number').attr('readonly', true);
	                      }




	                });


	                jQuery('.validar-input').unbind('keyup change input paste').bind('keyup change input paste',function(e){
	                    var este = jQuery(this);
	                    var val = este.val();
	                    var valLength = val.length;
	                    var maxCount = este.attr('maxlength');
	                    if(valLength>maxCount){
	                        este.val(este.val().substring(0,maxCount));
	                    }
	                }); 


	            });


	        </script>

	        <div class='box_donaciones'>

	        <form class='main_form'>

	            <div class='donaciones-page1 page-donaciones'>

	                    <div class='botones'>
	                   

	                        <a class='btn_don' data-name='mensual'>MENSUAL</a>
	                        <a class='btn_don active' data-name='unica'>ÚNICA</a>

	                    </div>

	                    <div class='info_donacion'>
	                        <div class='img'>
	                            <img src='". wp_get_attachment_image_src($imagen3, 'full')[0] ."' />
	                        </div>
	                        <div class='info_main'>".
	                            $text3

	                        ."</div>

	                        <div class='clr'></div>

	                    </div>

	                    <div class='box_values'>
						 	<ul>
	                            <li><a data-mount='". $title."' data-desc='". $text."' data-image='". wp_get_attachment_image_src($imagen1, 'full')[0] ."'>$". $title ."</a></li>
	                            <li><a data-mount='". $title2 ."' data-desc='". $text2."' data-image='". wp_get_attachment_image_src($imagen2, 'full')[0]."'>$". $title2 ."</a></li>
	                            <li><a data-mount='". $title3 ."' class='active' data-desc='". $text3 ."' data-image='". wp_get_attachment_image_src($imagen3, 'full')[0]."'>$". $title3."</a></li>
	                            <li><a data-mount='otro' data-desc='". $text4 ."' data-image='". wp_get_attachment_image_src($imagen4, 'full')[0]."'>Otro</a></li>
	                        </ul>

	                        <div class='text-box'>Suma que deseas donar</div>


	                        <div class='valor'>
	                        MX$ <input class='form-input monto-number' name='mount' value='". $title3."' readonly type='number' placeholder='Escribe el valor'>
	                        </div>

	                        <div class='mensaje'></div>

	                        <a class='btn_send'>AYUDAR</a>

	                        <div class='seguridad'>

	                            <table width='100%' cellpadding='0' cellspacing='0'>
	                                <td class='sec'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</td>
	                                <td>ACN es auditado por: KPMG</td>

	                            </table>


	                        </div>

	                        <div class='clr'></div>


	                    </div>

	            </div>

	            <div class='donaciones-page2 page-donaciones'>

	                        <div class='top_donaciones'>

	                            <div class='seguridad'>

	                            <table width='100%' cellpadding='0' cellspacing='0'>
	                                <td align='left'><a class='volver1 volver'><img src='". get_template_directory_uri(). "/img/arrow.png' /></a></td>
	                                <td class='sec2'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</td>
	                                

	                            </table>

	                            </div>

	                       </div>

	                       <div class='main_donaciones'>

	                             <h2> ". $frase1 ."</h2>
	                             Tu donación:  MX$<span class='mont_1'></span> <span class='mont_2'>mensuales</span><br><br>

	                             <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='110'><img src='". get_template_directory_uri(). "/img/nombre.png' /> Nombre* :</td>
	                                    <td> <input class='nombre' name='nombre' type='text'></td>
	                                    

	                                </table>

	                             </div>

	                            <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='110'><img src='". get_template_directory_uri(). "/img/correo.png' /> Email* :</td>
	                                    <td> <input class='email' type='email' name='email'></td>
	                                    

	                                </table>

	                            </div>

	                            <div class='campo-field last'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='110'><img src='". get_template_directory_uri(). "/img/celular.png' /> Celular :</td>
	                                    <td> <input class='celular validar-input' name='celular' type='tel'></td>
	                                    

	                                </table>

	                             </div>

	                            

	                             <input type='hidden' class='periodo' name='periodo' value='una sola vez'>

	                             <input type='hidden' class='estado_datos' name='estado_datos' value='parcial'>
	                             <input type='hidden' class='metodo_pago' name='metodo_pago' value='payu'>

	                             <input type='hidden' class='para_validar' name='para_validar' value='normal'>

	                             <input type='hidden' class='id_registro' name='id_registro' value=''>
	                             <input type='hidden' class='correo_admin' name='correo_admin' value='". $correo. "'>

	                             <div class='mensaje2'></div>

	                             <a class='btn_send2'>Siguiente</a>


	                       </div>

	            </div>


	            <div class='donaciones-page3 page-donaciones'>

	                        <div class='top_donaciones'>

	                            <div class='seguridad'>

	                            <table width='100%' cellpadding='0' cellspacing='0'>
	                                <td align='left'><a class='volver2 volver'><img src='". get_template_directory_uri(). "/img/arrow.png' /></a></td>
	                                <td class='sec2'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</td>
	                                

	                            </table>

	                            </div>

	                       </div>

	                       <div class='main_donaciones'>

	                             <h2> La mayor prueba de las víctimas del terremoto: reconstruir sus vidas</h2>
	                             Tu donación:  MX$<span class='mont_1'></span> <span class='mont_2'>mensuales</span><br>

	                             <img src='". get_template_directory_uri(). "/img/tarjetas.png' />

	                             <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'><img src='". get_template_directory_uri(). "/img/tarjeta.png' /> Tarjeta:</td>
	                                    <td> <input class='tarjeta validar-input' name='tarjeta' type='number' maxlength='16'></td> 

	                                </table>

	                             </div>

	                            <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'><img src='". get_template_directory_uri(). "/img/fecha.png' /> EXP:</td>
	                                    <td> 

	                                       <select name='month' class='month'>
	                                                <option value='01'>01</option>
	                                                <option value='02'>02</option>
	                                                <option value='03'>03</option>
	                                                <option value='04'>04</option>
	                                                <option value='05'>05</option>
	                                                <option value='06'>06</option>
	                                                <option value='07'>07</option>
	                                                <option value='08'>08</option>
	                                                <option value='09'>09</option>
	                                                <option value='10'>10</option>
	                                                <option value='11'>11</option>
	                                                <option value='12' selected='selected'>12</option>
	                                      </select>

	                                       <select name='year' class='year'>
	                                                <option value='2017' selected='selected'>2017</option>
	                                                <option value='2018'>2018</option>
	                                                <option value='2019'>2019</option>
	                                                <option value='2020'>2020</option>
	                                                <option value='2021'>2021</option>
	                                                <option value='2022'>2022</option>
	                                                <option value='2023'>2023</option>
	                                                <option value='2024'>2024</option>
	                                                <option value='2025'>2025</option>
	                                                <option value='2026'>2026</option>
	                                                <option value='2027'>2027</option>
	                                                <option value='2028'>2028</option>
	                                                <option value='2029'>2029</option>
	                                                <option value='2030'>2030</option>
	                                                <option value='2031'>2031</option>
	                                                <option value='2032'>2032</option>
	                                                <option value='2033'>2033</option>
	                                                <option value='2034'>2034</option>
	                                                <option value='2035'>2035</option>
	                                                <option value='2036'>2036</option>
	                                                <option value='2037'>2037</option>
	                                        </select>


	                                  


	                                    </td>
	                                    

	                                </table>

	                             </div>

	                            <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'><img src='". get_template_directory_uri(). "/img/cvc.png' /> CVC:</td>
	                                    <td> <input class='cvc validar-input' maxlength='4'  type='number' name='cvc'></td>
	                                    

	                                </table>

	                             </div>

	                             <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'> <input class='acepto' type='checkbox' name='acepto'>  Quiero un recibo de donación para la deducción fiscal </td>
	                                   
	                                    

	                                </table>

	                             </div>
								 
								 <div class='campo-field last'>
	                                <a class='btn_otros'>Otra forma de pago</a>
	                             </div>

	                              <div class='mensaje3'></div>


	                             <a class='btn_send3'>Donar MX$100</a>


	                       </div>

	            </div>


	            <div class='donaciones-page5 page-donaciones'>

	                        <div class='top_donaciones'>

	                            <div class='seguridad'>

	                            <table width='100%' cellpadding='0' cellspacing='0'>
	                                <td align='left'><a class='volver3 volver'><img src='". get_template_directory_uri(). "/img/arrow.png' /></a></td>
	                                <td class='sec2'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</td>
	                                

	                            </table>

	                            </div>

	                       </div>

	                       <div class='main_donaciones'>

	                             Usted ha elegido otras formas de pago para realizar su donación de <strong>MX$<span class='mont_1'></span> <span class='mont_2'>mensuales</span></strong><br><br>

	                             ". $frase2 ." <br><br>

	                             <strong> ¿Cómo quieres hacer tu donación? </strong><br><br>


	                             <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'><input type='radio' name='tipo_pago' checked='checked' value='oxxo'></td>
	                                    <td> En cualquier tienda Oxxo </td> 

	                                </table>

	                             </div>


	                            <div class='campo-field'>

	                                <table width='100%' cellpadding='4' cellspacing='0'>

	                                    <td width='100'><input type='radio' name='tipo_pago' value='Depósito bancario'></td>
	                                    <td> Depósito bancario </td> 

	                                </table>

	                             </div>
	                             


	                             <a class='btn_send5'>De acuerdo llámame</a>


	                       </div>

	            </div>



	            <div class='alerta'>

	                <div class='info_alerta'>

	                    <img src='". get_template_directory_uri(). "/img/spinner.gif' /><br><br>
	                    <span>Estamos procesando tu donación,</span><br><br>
	                   

	                    <div class='sec'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</div>
	                                

	                           <br><br>
	                            ACN ES AUDITADA POR KPMG



	                </div>


	            </div>




	            <div class='donaciones-page4 page-donaciones'>


	                <div class='top_donaciones'>

	                            <div class='seguridad'>

	                            <table width='100%' cellpadding='0' cellspacing='0'>
	                                <td align='left'><a class='volver4 volver'><img src='". get_template_directory_uri(). "/img/arrow.png' /></a></td>
	                                <td class='sec2'><img src='". get_template_directory_uri(). "/img/seguridad.png' />Este es un sitio seguro</td>
	                                

	                            </table>

	                            </div>

	                       </div>

	               

	                

	                <div class='form_final'>

	                    <strong> ". $frase3 ."</strong>

	                    <span class='gris'> ". $frase4 ."</span>

	                    <span class='verde'>Si quieres recibir nuestro boletín, déjanos tu dirección.</span>

	                        <table width='100%' cellpadding='4' cellspacing='0'>

	                            <tr>

	                                    <td>

	                                        <div class='campo-field'>
	                                            Calle:
	                                            <input class='calle' type='text' name='calle'>
	                                         </div>

	                                    </td>
	                                    <td>
	                                         <div class='campo-field'>
	                                            Nº:
	                                            <input class='numero_calle' type='text' name='numero_calle'>
	                                         </div>

	                                    </td>
	                                 
	                            </tr>

	                            <tr>

	                                    <td>

	                                        <div class='campo-field'>
	                                            Colonia:
	                                            <input class='colonia' type='text' name='colonia'>
	                                         </div>

	                                    </td>
	                                    <td>
	                                         <div class='campo-field'>
	                                            CP:
	                                            <input class='cp' type='text' name='cp'>
	                                         </div>

	                                    </td>
	                                 
	                            </tr> 

	                             <tr>
	                                   <td>

	                                        <div class='campo-field'>
	                                            Del./Mpio:
	                                            <input class='municipio' type='text' name='municipio'>
	                                         </div>

	                                    </td>
	                                    <td>
	                                         <div class='campo-field'>
	                                            Estado:
	                                            <input class='estado' type='text' name='estado'>
	                                         </div>

	                                    </td>
	                            </tr> 

	                            <tr>
	                                   <td>


	                                        <div class='mensaje4'></div>

	                                          <a class='btn_send4'>ENVIAR</a>
	                                    </td>
	                                    <td>
	                                        

	                                    </td>
	                            </tr> 

	                            <tr>
	                                   <td colspan='2' class='copy'>
	                                         <img src='". get_template_directory_uri(). "/img/correo.png' /> Por seguridad de las informaciones, te enviamos un e-mail confirmando tu donación.
	                                    </td>
	                                  
	                            </tr>    

	                         </table>




	                           

	                                

	                            




	                </div>





	            </div>




	        </form>



	        </div>




	        ";       
	         
	        return $html;
	         
	    }
	     
	} // End Element Class
	 
	 
	// Element Class Init
	new vcInfoBox();

	?>