<?php

return [

    /*
    Spec columns, self explanatory.
    */
    'columns' => [
        'numeric_columns' => [
            'rows' => ['created_at', 'updated_at', 'level', 'id',
                'acct', 'count', 'latitude', 'longitude',
                'year', 'zip', 'zipcode'],
            'class' => 'fa fa-sort-numeric'
        ],
        'amount_columns' => [
            'rows' => ['balance', 'change', 'ending', 'opening', 'price'],
            'class' => 'fa fa-sort-amount'
        ],
        'alpha_columns' => [
            'rows' => ['name', 'description', 'email', 'slug',
                'abbr', 'author', 'category', 'city', 'company', 'county',
                'country', 'customer',
                'eco', 'event', 'game', 'quote', 'label', 'locale', 'state', 'site', 'title', 'vendor'],
            'class' => 'fa fa-sort-alpha',
        ],
    ],

    /*
    Defines icon set to use when sorted data is none above.
    */
    'default_icon_set' => 'fa fa-sort',

    /*
    Icon that shows when generating sortable link while column is not sorted.
    */
    'sortable_icon' => 'fa fa-sort',

    /*
    Default anchor class, if value is null none is added. (must be type of null)
    */
    'anchor_class' => 'report-headings'

];