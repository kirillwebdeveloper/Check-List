> Content Checker API
>>
> Get count of used words from the content.

REQUIREMENTS
------------
      php                   >7.1

INSTALLATION
------------
    .env                    copy .env.example .env
    composer                composer install

RUN TESTS
-----------
    command                 php bin/phpunit

API
-----------
    TYPE:                   REQUEST
    METHOD:                 POST
    ROUTE:                  /api/checklist
    FIELDS:                 - list*
                            - content*
                            
    TYPE:                   RESPONSE
    FIELDS:                 - content
                            - keywords_used
                            - average_keywords_density