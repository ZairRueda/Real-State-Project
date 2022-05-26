<?php 

namespace Model;
// ==== HERENCIA EN EL PROYECTO ====

// -> La herencia es la capasidad del codidigo de reutilizacion 
// -> en multiples clases adyacentes o subyacentes

// -- Hemos mobido aca todo lo que contenia la clase Propiedad para 
// -- extenderla 
class ActiveRecord {

    // Para mandar a la BD podriamos cerar una insrtancia en la funcion __Construct 
    // pero eso consimiria mucha RAM por que se estaria activando constantemente
    // Para evitar eso crearemos un ELEMENTO ESTATICO
    // === BASE DE DATOS === 
    // -> esta nos servira para las multiples instacias y se manda a traer con self
    protected static $db;
    // Creamo un arreglo para poder iterar sobre cada uno de los elementos 
    // Las propiedades de este arreglo seran pasadas en su respectivo archivo para que 
    // puedan ser reescritas y seran traidas por medio de static::
    protected static $columnasDB = [];
    // Para poder eredar el metodo ALL() y que se mande traer con otra funcion
    protected static $tabla = '';

    // Errores 
    protected static $errores = [];

    // Definor la Conexion la base de datos
    public static function setDB($database){
        // Para hacer referencia a los atributos estaticos que hacen referencia en la clase y no requieren instaciarce
        // Propiedad::$db;
        // 0...
        self::$db = $database;
    }

    
    // == Parte de Actualizar ==
    // Fue creada para que Actualizar y Crear se guarden con un mismo metodo
    public function guardar() {
        // $this->id : nos hace referencia a que el objeto tiene un id, lo utilizamos como comprovacion, por logica, por que al crear un elemento, este no tendra uno
        // Cambiamos el isset por el is_null, para comprivar su un atrubuto esta como null
        if (!is_null($this->id)) {
            // Actualizando
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    // Guardar para integracion en la base de datos
    public function crear() {
        // Sanitizar los datos (en POO) [Asi se manda a llamar un metodo dentro de otro metodo]
        $atributos = $this->sanitizarAtributos();
        // Verificamso que los datos sean los mismos
        // debuguear($atributos);

        /*
        // Modificacion de arreglo a String para integracion
        // Join: creara un string apartir de un arreglo (toma dos parametros 1:  El separador - que separa a los atributos (', ' ) 2: Arreglo a Aplanar (', ', array_keys($atributos)) )
        $string = join(', ', array_keys($atributos));
        $string = join(', ', array_values($atributos));
        */

        // Una fucnion para obtener las Keys
        // debuguear(array_keys($atributos));

        /*
        // Incercion en la base de datos
        // Al ser propiedades de la clase se escriben sin $ y quedan $this->propiedadTal...
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion','$this->habitaciones','$this->wc','$this->estacionamiento', '$this->creado','$this->vendedorId' ) ";
        */
        // YA MODIFICADA LA INCERCION ( usaremos una concatenador en Variable ( .= ) )
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        // Al ser Strings se colocan comillas sensillas sobre comillas dobles, al igual que nuestro join que debe tener comillas simples dentro de comillas dobles
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // debuguear($query);

        $resultado = self::$db->query($query);

        // La redireccion, por funcionalidad ahora se agregara en este espacio
        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        $atributos = $this->sanitizarAtributos();

        // Este arreglo ira a el objeto en memoria y unira atributos con valores
        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
            // Este texto no se puede pasar a la base de datos como arreglo, para ello usaremos una variable de PHP llamada JOIN : que lo transforma a string
        }

        // debuguear(join(', ', $valores));

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        // A los ID se les agrega un escape_string para evitar la inyeccion de codigo externa
        $query .= " WHERE id = '" . self::$db->escape_string($this->id). "' ";
        $query .= " LIMIT 1 ";

        // debuguear($query);
        
        $resultado = self::$db->query($query);

        // debuguear($resultado);
        
        // La redireccion, por funcionalidad ahora se agregara en este espacio
        if ($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar un Registro
    public function eliminar(){

        // debuguear($algo);

        // Verificar que funciona Y el id del que se elimina
        // debuguear('Eliminando...' . $this->id);

        // A los ID se les agrega un escape_string para evitar la inyeccion de codigo externa
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";

        // debuguear($query);

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Para borrar la imagen del servidor
            $this->borrarImagen();

            header('location: /admin?resultado=3');
        }
    }

    

    // Identificar y unir los atributos de la BD
    public function atributos() {
        // Se vuelve a iterar sobre ellos para agregarlos 
        $atributos = [];

        

        //TODO Recordatorio: al ser Static, se manda a traer on self
        foreach(static::$columnasDB as $columna){
            
            // El ID no sera necesario ya que se le asignara ya dentro de la BD 
            if($columna === 'id') continue; // <- continue es revsara que se compla la condicion y la ignorara para ir al siguiente

            // Importante: al ser una variable si se escribe $this->$columna si fuera uan propiedad seria $this->columna
            $atributos[$columna] = $this->$columna;
        };

        // debuguear($atributos);
        // TODO Recordatorio: al usar la estructura ActiveRecord, tenemos que tener una copia ejecutandoce en memoria
        return $atributos;
    }

    // Se sanitizan antes de enciarse a la base de datos 
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        // debuguear($atributos);

        $sanitizado = [];

        // debuguear($atributos);

        // Key: seran las llaves osea nombres de la casilla
        // Value: seran los valores 
        foreach($atributos as $key => $value){
            // Se les agrega un escape_string para evitar la inyeccion de codigo externa
            $sanitizado[$key] = self::$db->escape_string($value);
        };

        // Verificamos que los elementois se haya enfiado de la misma manera y bien
        // debuguear($sanitizado);

        // Retornamos nuestro elemento para que este disponible en la clase principal como atributos
        return $sanitizado;
    }

    // Asignacion de la imagen
    // Subida de archivos, por medio de este metodo referencial se asiganara la imagen recivida si existe
    public function setImagen($imagen){ // <-- al darle una variable esperaremos que se agrege algo

        // Elimina la imagen previa, para que funcione en Actualizar
        if (!is_null($this->id)) {
            
            $this->borrarImagen();

            // CODIGO ANTERIOR PARA BORRAR LA IMAGEN
            // Comprovar si existe un archivo
            // $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            // Si existe la eliminamos del servidor
            // if ($existeArchivo) {
            //     unlink(CARPETA_IMAGENES . $this->imagen);
            // }
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
        // Se asiganar la imagen que pasemos al llamar el metodo
    }

    // Eliminar imagen al Eliminar elemento de la BD
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validacion
    // Servira para recivir el arreglo de errores en el archivo destino
    public static function getErrores(){

        return static::$errores;

    }

    // Este metodo se utiliza ya dentro del archivo destino para validar de la forma anterior
    // Revisando que no haya erroes
    public function validar(){

        

        // Para que cada que validemos limpiemos el arreglo anterior
        static::$errores = [];

        

        return static::$errores;

    }

    // Lista de todas las propiedades para integrar en administrador
    public static function all() {
        // Variable para instanciar la base de datos
        // $query = "SELECT * FROM propiedades";

        // Haciendo heredable el Call a the Data Bases
        // FIXME SELF hace referencia a la clase propia (literal eso significa en ingles)
        // Por eso no usaremos self. 
        // Usaremos STATIC : otro modificador de acceso 
        $query = "SELECT * FROM " . static::$tabla;

        // debuguear($query);

        // NOTE Cuando un codigo no es dinamico se le llama CODIGO DURO
        
        // Instancia a la BD
        $resultado = self::consultarSQL($query);

        // En activRecord no se puede usar esta sintaxis de abajo para treaer los elementos de la BD, tienen que usarce los objetos y multiples metodos para guardar una copia en sistema 
        // debuguear($resultado->fetch_assoc());
        return $resultado;
    }


    // NOTE == HERENCIA == 
    // Para mandar traer a los vendedores lo podriamos hacer de la misma manera que traemo propiedades y las demas llamdas a BDD
    // pero esto va encontra de los principios de reutilizacion asi que pora hacerlo reutilizable crearemos una clase principal
    // ====================


    // Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        // debuguear($query);

        $resultado = self::consultarSQL($query);

        return $resultado;
    }


    // == Actualizar Propiedades Metodo ==
    // Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        // debuguear($query);
        // Uno de los principales de ActiveRecord es la REUTILIZACION y aqui lo estamos aplicando
        $resultado = self::consultarSQL($query);
        // Esta funcion nos traera un arreglo de objetos con una unica posicion

        // SI lo que se quiere es traer solo el objeto sin el arreglo
        // Utilizamos una funcion llamada array_shift que lo que hara es traer el primer elemento de una arreglo
        return array_shift($resultado);
    }

    // === Consultar base e datos y transformacion a objeto ===
    // Este metodo es creado pensando en que sea global y reutilizable
    public static function consultarSQL($query){
        
        // Consultar BD
        $resultado = self::$db->query($query);
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            // Al usar ActiveRecord utilizamos objetos en memoria que seran un espejo de un elemento en este caso de la base de datos
            $array[] = static::crearObjeto($registro);
        }

        // TODO Dato importante : esto es un array pero en active record es necesario tener objetos no arreglos
        // Para transformar de objeto a arreglo usaremos la funcion crearObjeto
        // debuguear($array);
        
        // Liberar la memoria, para mayor eficacia
        $resultado->free();
        
        // Retornar los resultados
        return $array;
    }

    // Se crea esta variable con el fin de combertir un arreglo en un objeto
    protected static function crearObjeto($registro) {
        // new self: es una nueva propiedad de la clase padre
        // Y crea una nueva instancia usando el _constructor
        $objeto = new static;
        
        // Al ser un arreglo asociativo con llave y valor, asi mismo se pasara al foreach
        foreach($registro as $key => $value) {
            // property_exist  : verifica que una propiedad exista (ejemplo si el objeto tiene un id)
            // ................otro ejemplo seria verificar si existe en el _constructor una misma labe llamada id
            if( property_exists($objeto, $key) ){
                $objeto->$key = $value;

            }
        }

        // debuguear($objeto);
        return $objeto;
    }

    // == Parte de Actualizar == 
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    // Se modifica el objeto en memoria y se mantine en lo que se manda a la BDD
    public function sincronizar($args = []){
        // debuguear($args);

        // Como reescribir cada uno de los elementos
        // AL tratarse de un arreglo usaremos Foreach 
        // Al ser un arreglo asociativo usamos un KEY y un VALUE
        foreach($args as $key => $value) {
            // Estaremo revisando: 
            // -> con this si una propìedad existe en nuestro arreglo 
            // -> y contenga llaves de nuestro arreglo
            // -> con && !is_null($value) verificamos que no venga vasio
            if( property_exists($this, $key) && !is_null($value)){
                // Al asignar la variable KEY nos evitamos estar asignando uno por uno las propiedades del metodo
                $this->$key = $value;
            }
            // Estaremos comparando nuestro objeto que en FIND() con el arreglo que esta en POST en el archivo Actualizar
        }
    }

}

// ==== NOTAS ====
// Hemos modificado propiedades por static::$tabla para la incercion 
// de los vendedore y hacer un codigo mas heredable

// =*=*=*= Recordatorios =*=*=*=

// =* Los metodos public pueden ser llamados fuera de la clase o en otro documento
// =* los metodos protected o private solo pueden ser usados en la misma clase