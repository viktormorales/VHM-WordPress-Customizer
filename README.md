# VHM WordPress Customizer

Estoy trabajando en una clase para crear paneles y secciones automáticamente en el Personalizador de WordPres.

<img style="width:100%" src="https://github.com/viktormorales/VHM-WordPress-Customizer/blob/master/example.jpg">

## Instalación
* Descargar los archivos.
* Ubicar el archivo **customizer.php** y la carpeta **js/theme-customizer.js** en el ROOT de la plantilla (ej.: wp-content/themes/twentysixteen/);
* Incluir **customizer.php** en el archivo **functions.php**: `require(dirname(__FILE__) . '/customizer.php');`
* Ir a la opción Personalizar **Apariencia > Personalizar**.

## Opciones personales
Para agregar o quitar paneles, abrir el archivo **customizer.php** y modificar la variable `self::$panels` siguiendo el ejemplo a continuación:

```
// Define paneles con el formato 'ID' => 'NOMBRE'
self::$panels = array(
	'about' => __('About', TEXTDOMAIN),
	'services' => __('Services', TEXTDOMAIN),
	'contact' => __('Contact', TEXTDOMAIN)
);
```

Y luego ubique las secciones en la plantilla con el siguiente formato:

```
<section id="ID">
	<h2 id="ID-title"><?php echo get_theme_mod('about_main_title'); ?></h2>	
	<div id="ID-template"><?php echo do_shortcode(get_theme_mod('ID_template')); ?></div>
</section>
```
**NOTA: Debe reemplazar ID por el valor que se haya asignado cuando se defineron los panels, en nuestro ejemplo quedaría:**

```
<section id="about">
	<h2 id="about-title"><?php echo get_theme_mod('about_main_title'); ?></h2>	
	<div id="about-template"><?php echo do_shortcode(get_theme_mod('about_template')); ?></div>
</section>
<section id="services">
	<h2 id="services-title"><?php echo get_theme_mod('services_main_title'); ?></h2>	
	<div id="services-template"><?php echo do_shortcode(get_theme_mod('services_template')); ?></div>
</section>
<section id="contact">
	<h2 id="contact-title"><?php echo get_theme_mod('contact_main_title'); ?></h2>	
	<div id="contact-template"><?php echo do_shortcode(get_theme_mod('contact_template')); ?></div>
</section>
```

## Author
* Viktor H. Morales ([viktormorales.com](http://viktormorales.com))

## License
Released under the [MIT license](http://www.opensource.org/licenses/MIT).
