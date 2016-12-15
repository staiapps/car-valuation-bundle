# tasador-de-coches
Bundle para Symonfy 2, el cual permite incluir un formulario para la realización de tasaciones de vehículos.

# INSTALACIÓN
## Paso 1: Instalar usando [Composer](https://getcomposer.org/) 

```shell
 cd /PATH/TO/YOUR/PROJECT

 $ composer require staiapps/tasador-de-coches
```

### Paso 1.1: Añadir la siguiente línea al archivo: `app/AppKernel.php` 
```php
new Aiapps\ValuationFormBundle\AiappsValuationFormBundle(),
```

```php
<?php
//"app/AppKernel.php"
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ..........
            new Aiapps\ValuationFormBundle\AiappsValuationFormBundle(),
        );
    ..................
```
## Paso 2: Añadir los parámetros de configuración del bundle a `app/config/config.yml`
```
......................
aiapps_valuation_form:
   parameters:
       apikey: '123456789012345678901234567890123456789'
       email: ‘email@ejemplo.com'
       terms: 'http://terminos-condiciones'
```
#### Descripción de parametros
* **apikey**: clave que te permite acceder a nuestro backend. Solicita tu clave: [Obtener ApiKey](http://staiapps.com/app/tasador-de-coches/)
* **email**: email dónde llegarán las tasaciones que realizan los usuarios.
* **terms**: debes indicar la ruta de página de tu web donde se deben mostrar los términos y condiciones de uso del tasador.

## Paso 3: Añadir dependencias CSS y Javascript
A continuación, procederemos a añadir las dependecias a nuestro archivo **base.html.twig** de la web Symfony, es posible que pueda tener otro nombre Ej:`base-layout.html.twig`, normalmente almacenados en `app/Resources/views`: 
*  **Requisitos**:
  * [Boostrap](http://getbootstrap.com/getting-started/)
  * [JQuery](https://code.jquery.com/)

#### Si Boostrap y JQuery **NO** se encuentran instalados, podemos añadir el siguiente código el cual también añade las dependencias con Boostrap y JQuery  (`base.html.twig`)

```html
..........
    <head>
        .......................
        {% block stylesheets %}
            {% stylesheets
            '@AiappsValuationFormBundle/Resources/public/css/*'
            %}
            <link rel="stylesheet" href="{{ asset_url }}" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('bundles/aiappsvaluationform/css/style.css') }}" type="text/css" media="all" />
            {% endstylesheets %}
        {% endblock %}
        .......................
    </head>
    ...........................
    <body>
        ...........................
        {% block javascripts %}
            {% javascripts
            '@AiappsValuationFormBundle/Resources/public/js/*'
            %}
            <script src="{{ asset_url }}"></script>
            <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            {% endjavascripts %}
        {% endblock %}
        ...........................
    </body>
```

#### Si Boostrap y JQuery **SI** se encuentran instalados, añadimos únicamente las siguientes líneas  (`base.html.twig`)

```html
..........
    <head>
        .......................
        {% block stylesheets %}
            {% stylesheets
            '@AiappsValuationFormBundle/Resources/public/css/*'
            %}
            <link rel="stylesheet" href="{{ asset_url }}" />
            <link rel="stylesheet" href="{{ asset('bundles/aiappsvaluationform/css/style.css') }}" type="text/css" media="all" />
            {% endstylesheets %}
        {% endblock %}
        .......................
    </head>
    ...........................
    <body>
        ...........................
        {% block javascripts %}
            {% javascripts
            '@AiappsValuationFormBundle/Resources/public/js/*'
            %}
            <script src="{{ asset_url }}"></script>
            {% endjavascripts %}
        {% endblock %}
        ...........................
    </body>
```
## Paso 4: Mostrar el formulario de tasación
 A continuación tenemos que elegir dónde queremos mostrar el formulario de tasación.
 
### Paso 4.1 Accedemos al `Controller` del html elegido:

Dentro de la función que renderiza el **html** de la página, le pasaremos el siguiente parámetro:
```php
'valuationForm' => $this->get('app.valuation.form')->showValuation()
```
**Ejemplo:**
```php
<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:prueba.html.twig', array(
            'valuationForm' => $this->get('app.valuation.form')->showValuation()
        ));
    }
}
```

### Paso 4.2 Accedemos al `HTML` elegido:

Accedemos al **html** donde asignaremos el formulario y añadimos la siguiente línea, en el lugar donde queramos que aparezca:
```
{{ valuationForm | raw }}
```

**Ejemplo**: (Siguiendo el ejemplo anterior nuestro **html** es `prueba.html.twig`):
```html
{% extends '::base.html.twig' %}

{% block page_title %}
{% endblock %}

{% block page_subtitle %}
{% endblock %}

{%  block body %}
   <h2>TASADOR:</h2>
   {{ valuationForm | raw }}
{% endblock %}
```


## Paso 5: Introducir los siguientes comandos:

* #### En caso de **NO** tener instalado `assetic-bundle` *(no incluido por defecto en la versión 2.8 y en adelante)* deberemos instalarlo:
  http://symfony.com/doc/current/assetic/asset_management.html



* #### Por último, escribimos el siguiente comando:
```shell
$ php app/console assets:install
```
