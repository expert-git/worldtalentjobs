<?php

return [
    # Define your application mode here
    'mode' => 'sandbox',

    # Account credentials from developer portal
    'account' => [
        'client_id' => 'AXMghtuIzL4DsrjXSn6PIBU9dA4dGwNPgeTv3vfLVv-IzXCOF_tyimzVj7HjQxEZizXb4WIF70g-sUnX',
        'client_secret' => 'EMBoK-tU7AKvDlA0vMy7wl46rvb0Zl5HgxZCD_J_qWRerAgjZidf8xVOzXsXWFg8YOq6tzpCdgkE_47b',
    ],

    # Connection Information
    'http' => [
        'connection_time_out' => 30,
        'retry' => 1,
    ],

    # Logging Information
    'log' => [
        'log_enabled' => true,

        # When using a relative path, the log file is created
        # relative to the .php file that is the entry point
        # for this request. You can also provide an absolute
        # path here
        'file_name' => '../PayPal.log',

        # Logging level can be one of FINE, INFO, WARN or ERROR
        # Logging is most verbose in the 'FINE' level and
        # decreases as you proceed towards ERROR
        'log_level' => 'FINE',
    ],
];
