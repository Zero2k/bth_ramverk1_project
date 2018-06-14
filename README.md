bth_ramverk1_project - coinOverflow
==================================

[![Latest Stable Version]()]()
[![Build Status]()]()
[![Build Status]()]()
[![Code Coverage]()]()
[![Scrutinizer Code Quality]()]()

## Add Database to Project

```
cd config/
touch database.php

CODE:

<?php

return [
    "dsn"             => "mysql:host=localhost;dbname=dbname",
    "username"        => "username",
    "password"        => "password",
    "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => "",
    "session_key"     => "Anax\Database",
    // True to be very verbose during development
    "verbose"         => null,
    // True to be verbose on connection failed
    "debug_connect"   => false,
];
```

## License

This software carries a MIT license.

```
 .  
..:  Copyright (c) 2018 Viktor Bengtsson (vibe16@student.bth.se)
```
