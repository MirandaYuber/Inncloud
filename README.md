# Innclod

## Configuración para despliegue

- En la carpeta `.devops/docker/develop` debe hacer una copia del archivo `docker-compose.override.example.yml`
  con el nombre `docker-compose.override.yml`.

- Crear una red de Docker:
  ```bash
  docker network create innclod-network
  ```
  > 📝
  > Si desea cambiar los puertos de la base de datos y del servidor de Nginx en el que se exponen.
  > Cambielos en el archivo `.devops/docker/develop/docker-compose.override.yml`

- Configurar las variables de entorno haciendo una copia del archivo `.env.example`:
  > 📝
  > Si hizo algún cambio en las credenciales o contenedor de la base de datos, ajustarlas las variables de entorno
  > a las nuevas ya que la base de datos está conectada al contenedor `innclod-db`

- Construir y levantar el contendor con el siguiente comando:
  ```bash
  docker-compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml up --build
  ```

- Para acceder al bash del contenedor con el siguiente comando:
  ```bash
  docker exec -it innclod-app bash
  ```

- Al ingresar al contenedor, se debe ejecutar el siguiente comando para poder instalar todas las dependencias del proyecto:
  ```bash
  composer install
  ```
- También ejecutamos el siguiente comando para ejecutar las migraciones, las cuales crearán las tablas necesarias para él
  proyecto junto con algunos registros de las mismas:
  ```bash
  php artisan migrate
  ```
- Y por último, generamos la key de la aplicación:
  ```bash
  php artisan key:generate
  ```
  > 📝
  > Para bajar el contenedor de la aplicación, ejecutar el comando
  > ```
  > docker-compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml down
  >```

### Autor:
Yuber Esteban Miranda Mojica

### Correo:
mirandayuber7@gmail.com
