## Installation
There are 3 different ways to run the project and api;

- If you have docker installed, this is the recommended way;

```bash
$ git clone https://github.com/ydlgr/mars-rover.git && cd mars-rover
$ docker-compose up -d
$ docker ps
```
There will be two containers.
Go to the php container with ; 
```bash
$ docker exec -it {php_container} bash
```
In the php container terminal , run ;
```bash
$ composer install
```

- If you have symfony binary installed;
```bash
$ git clone https://github.com/ydlgr/mars-rover.git && cd mars-rover/app
$ composer install
$ symfony serve --port 8000 --allow-http --no-tls
```


- If you have php binary installed;
```bash
$ git clone https://github.com/ydlgr/mars-rover.git && cd mars-rover/app
$ composer install
$ php -S 0.0.0.0:8000 -t public
```

### **Api Endpoints**

```url
http://127.0.0.1:8000/plateau
http://127.0.0.1:8000/rover
http://127.0.0.1:8000/move
```

| Verb        | URI           | Action  | Name  |
| ------------- |:-------------:| -----:| -----:|
| POST      | /plateau | store | plateau_store |
| GET      | /plateau/{id}      |   show | plateau_show |
| POST | /rover      |    store |  rover_store |
| GET | /rover/{id}      |    show |  rover_show |
| POST | /move      |    move |  move |

### **Explanations**

- There are two service classes in the Service folder which keep the plateau and rover data in memory.
This services implement their own interfaces.
  
- Unit tests should be run sequentially to store Plateau and Rover data.
  That's why the following lines were added to the phpunit.xml.dist file.

```bash
    <testsuites>
        <testsuite name="Mars Rover Test Suite">
            <file>tests/Functional/PlateauServiceTest.php</file>
            <file>tests/Functional/RoverServiceTest.php</file>
            <file>tests/Functional/MoveRoverServiceTest.php</file>
        </testsuite>
    </testsuites>
```

- The main idea of calculation coordinates and direction is to use Direction and Command interfaces. 
If we want to add more directions in the future, it will just be enough to add the new class under Direction folder and implement Direction interface.
The Rover uses MoveForward, SpinLeft, SpinRight classes which all implement CommandInterface.
  
- All three services(RoverService, PlateauService, MoveRoverService) have their own Validation rules in the Validation folder.

- Util/CustomObjectNormalizer class was used to normalize ( object to array ).

### **Tests**
in the app folder, run ; 

```bash
bin/phpunit
```
