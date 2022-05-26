# Parte de proyecto en POO

En MVC a los archivos poo se les conoces como Modelos
La carpeta que almecena los datos es models

Nuestra Clase Matris sera ActiveRecord, ya que estamos usando la arquitectura omonima

Es esta tenemos:

- Declaracion de constantes
    - $db <- recibira la base de datos y se usara para iterar el CRUD
    - $columnasDB <- recivira las columnas de la base de datos a modificar
    - $tabla <- recivira la tabla de la cual se modificaran los datos
    - $errores <- recivira el respectivo arreglo de errores

- Funcion setDB :
    Recibe un parametro que sera el llamado a la bace de datos
    este atributo se transforma a self para no tener que reinstanciar
    SELF : se usa para traer elementos de la propia clase
    STATIC : se usa para traer elementos no necesariamento de la misma clase, o para
             modificar el codigo y sea mas aredable y de facil instancia

- Funcion guardar :
    Es instanciada desde el controlador, por ende no se esta redando o interando por eso no es static o self
    Esta funcion hace un calcula envace a un parametro id, dependiendo de so guarda o actualiza

    - funcion guardar :
            $atributos <- Recibe atributos sanitizados de la funcion sanitizarAtributos() 
            por medio de un $this-> : el this es una propiedad contextual, hace referencia la clase misma
            $query <- se crea el query (codigo SQL INSERT INTO) valiendonos de un constructor ligero, 
            recibe la tabla actual, este va construyendoce con $atributos
            .= (significa una continuacion de la variable) y concatenado con " . tal . "
            usa tambien la funcion join : creara un string apartir de un arreglo toma dos parametros 
            1: El separador [ aqueyo separa a los atributos (', ' ) ] 
            2: Arreglo a Aplanar [ (', ', array_keys($atributos)) ]
            funcion array_keys : obtiene los keys/llaves de un arreglo
            La contrucion del query es la misma de un queri normal
            $resultado <- le asiganamos el self::$db (la intancia de la DB) la funcion 
            query (transforma y ejecuta una sentencia SQL en una única llamada a función)
            y a esta le asiganamos nuestro query
            Finalmento redirecionamos y enviamos una alerta a la pantalla principal


    - funcion actualizar
            $atrubitos <- lo mimo que en funcion guardar
            $valores <- variable que se usara para guardar los valores de los atributos, este se guarda en memoria
            Usamos un foreach para obtener los valores, los recontruirlos para poder usarlos en la funcion UPDATE y los agregamos a nuestra variable echa antes (los atributos queda asi titulo = '{$titulo}')
            $query <- recibe el parametro UPDATE, se le asigna la tabla y se construye como el query de crear, 
            con la diferencia en codigo SQL de que se recibe la construcion de los $valores y intergamos 
            WHERE para saber el elemento a modificar
            scape_string : nos ayuda a evitar inyeccion externa
            $resultado <- este y el siguiente igual que en crear 

    - fucnion eliminar
            $query : recibe el codigo SQL (DELETE) se le asigan la tabla y el $id ya modificado con scape_string 
            para inpedir inyeccion externa y un LIMIT de 1
            $resultado <- es el mismo que en crear
            la redireccion cambia solo en que ahora eliminaremos la imagen creada por medio de la 
            funcion borrarImagen()

- Funcion atributos
    $atrubutos <- guardara un arreglo de atribitos 
    foreach <- recibe las colimnas para iterar sobre ellas
            hace un calculo con if para no iterar el id y continuar
            A $atributos le asignamos el key de la columna y este sera igual a el valor de la columna
            que se obtubieron de el constructor
            Dato importante : se le pasa $this->$columna y no $this->columna, por el articulo que pasamos,
            es una varible
    Retornamos el arreglo de $atributos

- Funcion sanitizarAtributos
    $atributos <- recibe los atrubutos de la funcion atributos
    $sanitizado <- arreglo que recibira los atributos sanitizados
    foreach <- se le dan los atributos y se iterara su key y su value
            $sanitizado revibe como key el key de atributos, y como valor el valor de atributos pero
            ya pasado por la funcion escape_string
    retornamos $sanitizado

- Fucnion setImagen 
    recibe una imagen como primer parametro, este sera recibido desde el controlador con:
    ($propiedad->setImagen($nombreImagen);)
    if <- creau una funcion matematica en vace a que el id no sea null (!is_null)
    en caso de que sea verdad la funcion se borrara la imagen prebia con la funcion borrarImagen
    if <- se crea otra funcion matematica donde se comprueba el nombre de la imagen existe
    en caso de que sea verdad este se agregara a el atributo imagen

- funcion borrarImagen
    Verifica que un archivo exista en la carpeta de imagenes con la funcion file_exist :
    esta recibe la carpeta y el nombre del archivo actual
    if <- Si existe, se borrara con la funcion unlink : 
    que recibe la carpeta y el nombre del archivo actual

- funcion getErrores
    retorna el arreglo de errores

- funcion validar 
    itera sobre el arreglo de errores y lo limpia
    retorna el arreglo nuevo
    
- funcion all
    nos servira para la iteracion de siertas propiedades de una tabla
    se encarga de traer todos los elementos de una tabla determinada
    $query <- por medio de la sentencia de SQL SLECT * FROM se le asigna la tabla que la llama
    $resultado <- envia el query a la funcion consultaSQL 
    Retorna el $resultado

- funcion get 
    nos servira para la iteracion de ciertos elemento de una tabla
    se encarga de traer un determinado numero de elementos de una tabla, por ello recibe una $cantidad
    $query <- por la sentencia de SQL SELECT * FROM se le asigna la tabla que la llama y se le da 
    un LIMIT y se le asigna la $cantidad
    $resultado <- envia el queru a la funcion consultaSQL
     
- funcion find 
    nos servira para actualizar algun elemento
    se encarga de traer un elemento por medio de un $id asignado
    $query <- muy parecido al de get con la diferencia de el WHERE id = ${el id dado}
    $resultado <- se le pasa a la funcion consultarSQL
    retornamos
    Nuestro arreglo nos traera un arreglo de objetos (uno solo en este caso)
    Si lo que queremos es solo el objeto usamos la funcion 
    array_shift, le pasamos el $resultado y la retornamos 
    Esto hara que solo se pase el Objeto, hacemos todo esto por que lo que queremos iterar es solo 
    un objeto 

- fucnion consultaSQL 
    Esta funcion recibe un $query
    $resultado <- asigna a la BDD , por medio de la funcion query, nuetro $query
    Iteramos los resultado
    $array <- se integrara aqui el resultado
    While <- la variable $registro sera igual a $resultado que se a transformado en array asociativo
    por medio de la funcion fetch_assoc
    el arreglo $array recivira el resultado de $registro que fue modificado por la funcion crear Objeto
    Ya que al usar Active Record tenemos que guardar un objeto en memoria que es espejo de la base de datos
    Luego loveramos la memoria con $resultado->free()
    y retornamos nuestro arreglo $array

- fucnion crearObjeto
    Recibe como parametro un $registro
    $objeto <- sera una iteracion del elemento static osea la clase constexto donde es llamado
    foreach <- itera sobre el registro obteniendo su $key => y $valor
    por medio de property_exist : verifica que una propiedad exista (ejemplo si el objeto tiene un id)
    otro ejemplo seria verificar si existe en el _constructor una misma llabe llamada id
    If <- Verifica que el objeto tenga el $key del $registro
    si es asi, se le asiga al objeto el $key y sera igual a su valor
    Por ultimo retornamos el Objeto
    
- funcion sincronizar
    Esta funcion es llamada ya en el constrolador, mas especifico en actualizar
    Su funcion es seincronizar lo que hay en base de datos con lo que se muestra en pantalla
    Recibe como primer parametro un $arg/arreglo
    foreach <- itera sobre el arreglo obteniendo $keys => y $values
    rebisa si la propiedad $key exista y sea igual a la del objeto y si el $valor no es nulo
    luego a $key del objeto le asignamos el $valor actualizado


 


            