# Pallo: Common Library

Shared classes of the PHP Pallo framework.
    
## Decorators

Decorators are used to convert values from one context into another.
They should only act when the incoming value is handable.

    <?php
    
    use pallo\library\decorator\DateFormatDecorator;
    use pallo\library\decorator\StorageSizeDecorator;
    use pallo\library\decorator\VariableDecorator;
    
    // decorate dates into a formatted date
    $decorator = new DateFormatDecorator();
    $decorator->setDateFormat('y-m-d');
    $result = $decorator->decorate(1372582573); // 2013-06-30
    $result = $decorator->decorate(new DateTime('30 June 2013')); // 2013-06-30
    
    // decorate byte values into human readable format
    $decorator = new StorageSizeDecorator();
    $result = $decorator->decorate(5000); // 4.88 Kb 

    // decorate variables into a output string
    $decorator = new VariableDecorator();
    $result = $decorator->decorate(null); // 'null' 
    $result = $decorator->decorate(true); // 'true' 
    $result = $decorator->decorate(array('key' => 'value')); // '["key" => "value"]'  
    $result = $decorator->decorate(array($decorator)); // 'pallo\library\decorator\VariableDecorator'  

## Autoloader

The autoloader of the Pallo framework is a PSR-0 autoloader.

It handles class names like:

* pallo\library\Autoloader: checked as _pallo/library/Autoloader/php_
* pallo_library_Autoloader: checked as _pallo/library/Autoloader.php_ and _pallo_library_Autoloader.php_

    <?php
    
    use pallo\library\Autoloader;
    
    require_once('path/to/pallo/library/Autoloader.php');

    $autoloader = new Autoloader();
    $autoloader->addIncludePath('module1/src');
    $autoloader->addIncludePath('module2/src');
    $autoloader->addIncludePath('application/src'); // last added path will be checked first
    $autoloader->registerAutoloader();

## Error Handler

The error handler of the Pallo framework simply converts handable errors into exceptions.

    <?php
    
    use pallo\library\ErrorHandler;

    $errorHandler = new ErrorHandler();
    $errorHandler->registerErrorHandler();
    
## String

The string helper comes in handy when processing values.

    <?php
    
    use pallo\library\String;    
    
    $string = new String("Let's create a stràngé STRING");
    $result = $string->safeString(); // 'lets-create-a-strange-string'
    $result = $string->safeString('_', false); // 'Lets-create-a-strange-STRING'
    $result = $string->startsWith(array('yes', 'no')); // false
    $result = $string->startsWith(array('yes', 'no', 'Let')); // true
    $result = $string->startsWith('let'); // false
    $result = $string->startsWith('let', true); // true
    $result = $string->truncate(12); // 'Let's...'
    $result = $string->truncate(12, '...', true); // 'Let's cre...'
    
    $result = String::generate(10); // a random string of 10 characters
    
## Timer

A timer can be used to track time of actions.
It has a detail of microseconds.

    <?php
    
    use pallo\library\Timer;

    $timer = new Timer();
    $timer->reset();
    $time = $timer->getTime(); // get the current time and keep on going
    $time = $timer->getTime(true); // get the current time and reset