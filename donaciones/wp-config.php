<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'db707816683');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'dbo707816683');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'Z9%Mdej[ZRiM');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'db707816683.db.1and1.com');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '3rWNkh3}>gl<QJ)<P>[V,C[c]UNfEiJd&n2mj[j^Pcp3]^bH?98 tP8|_;_w:{0G');
define('SECURE_AUTH_KEY', 'Vq1ab*>jyY;KY+jXH#{$YrYoETU`7`a{>iO^+mI1y:{ht9UCg5C%|84ymCL4%PZv');
define('LOGGED_IN_KEY', 'YC{w/twqfg|.V`rdcaINxKoGeU=jKwWvTPb0Lx,%6z#SeM^Mzav1_bPBc33DCxTv');
define('NONCE_KEY', 'yk{~?*+qCICKz`&bk0dQg1xeQ|H?42XdBjDcNhRsLm.DF@P:a[QZ.{Jf:wFv1,.T');
define('AUTH_SALT', '<1wiO&Sk<@6Kx(s Eo8]BK0Sx*69p}LR)8/DRl}pk5v8xKGd$zKELK$J__RG3zc6');
define('SECURE_AUTH_SALT', '-8H{]3fCG(QueAf{/i>3.YsnJr%]c)j9JNsa3%I_]Tf*(1qR`[LcDC77+84@u}rR');
define('LOGGED_IN_SALT', 'J!;u73!oTcFv06>1|UXC%qHvl%CvkS]N$/YpeA#So~[!2(3l&o@$*`BIf]&s3S[E');
define('NONCE_SALT', 'e>Wk*HQ+uEb,oP4~<E[R>><Pvgv1/7M8gb3;)tSx4^gL%/7dK :9Al&:S2du-&%a');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

