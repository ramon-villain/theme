<?php

/**
 * application.php - Write your custom code below.
 */

Asset::add('th-screen', 'css/screen.css', false, '1.0', 'all');
$as = Asset::add('th-admin', 'js/admin.js', array('jquery'), '1.0.0', true)->localize('data', ['red', '1', 'green'])->to('admin');
$as->localize('xxx', ['sass', 'less', 'stylus']);

$al = Asset::add('th-log', 'js/log.js', false, '1.0.1', true)->to('login')->localize('logs', ['404', '503']);

$posts = [];
foreach(PostModel::all() as $post)
{
    $posts[$post->ID] = $post->post_title;
}

//$postModel = new PostModel();
//add_action('wp_footer', array($postModel, 'special'));

$metabox = Metabox::make('Link', 'post')->set([

    Field::color('theme-color'),
    Field::color('menu-color', ['title' => 'Menu Color']),
    Field::select('types', [
        [
            'flat' => 'Flat'
        ]
    ]),
    Field::text('hero'),
    Field::number('invites'),
    Field::number('tickets', array('info' => 'Define the number of tickets to sell.')),
    Field::date('when', array('title' => 'Date de sortie')),
    Field::media('pic', array('type' => 'application')),
    Field::media('pho', array('title' => 'Photo')),
    Field::collection('photo-list', array('info' => 'Some help text.', 'limit' => 2)),
    Field::collection('file-list', array('title' => 'Liste fichiers', 'info' => 'Une aide pour les utilisateurs.', 'type' => 'application')),
    Field::text('uh', array('class' => 'uh-custom-class', 'info' => 'Some help here.')),
    Field::text('doh'),
    Field::text('douh', array('title' => 'Weird Title')),
    Field::textarea('story', array('class' => 'textarea-class', 'default' => 'A long time ago..........')),
    Field::media('cover', array('default' => '166')),
    Field::editor('biography'),
    Field::checkbox('toggle', 'show'),
    Field::checkbox('colors', array('red', 'green', 'blue'), array('default' => 'green')),
    Field::checkbox('couleurs', array('rouge', 'vert', 'bleu'), array('default' => array('vert', 'bleu'))),
    Field::checkbox('farben', array('rose', 'pink', 'jaune')),
    Field::radio('size', array('small', 'medium', 'large'), array('default' => 'large')),
    Field::radio('length', array('tiny', 'normal', 'huge'), array('default' => array('tiny'))),
    Field::radio('gender', array('woman', 'man')),
    Field::select('related', array($posts), array('title' => 'Related post', 'default' => 115)),
    Field::select('country', [
        [
            [
                'text'  => 'belgium',
                'atts'  => ['id' => 'belgium-option']
            ],
            'france',
            'portugal'
        ]
    ], ['default' => 2]),
    Field::select('countries', array(
        array(
            [
                'text'  => 'belgium',
                'atts'  => ['data-publish' => 'Set to Belgium']
            ],
            'france',
            'portugal'
        )
    ), ['info' => 'Choose multiple countries'], ['class' => 'custom-select-class', 'multiple' => 'multiple']),
    Field::select('area', array(
        array(
            'be' => [
                'text'  => 'Belgium',
                'atts'  => ['data-publish' => 'Custom Belgium']
            ],
            'fr' => 'France',
            'pt' => 'Portugal'
        )
    ), array('default' => 'pt')),
    Field::text('actor', array('default' => 'Marcel')),
    Field::password('secret', array('title' => 'Mot secret', 'default' => 'passworddd', 'class' => 'passme')),
    Field::infinite('things', array(
        Field::text('sock'),
        Field::collection('sock-gallery'),
        Field::checkbox('registration', 'Enable')
    )),
    Field::infinite('stuffs', array(
        Field::text('stuff'),
        Field::media('image'),
        Field::password('key'),
        Field::text('name')
    ))

]);

$metabox->validate(array(
    'hero'      => array('required'),
    'actor'     => array('textfield', 'min:5'),
    'things'    => array(
        'sock'  => array('num')
    )
));

$books = PostType::make('jl_books', 'Books', 'Book')->set();

Metabox::make('Details', 'jl_books', array('id' => 'details-ID'))->set(array(
    Field::media('cover', array('type' => 'image')),
    Field::infinite('gallery', array(
        Field::media('gallery_item'),
        Field::text('subtitle')
    ))
));

Metabox::make('More information', $books->get('name'), ['context' => 'side'])->set([
    Field::text('isbn', ['info' => 'Insert ISBN code.']),
    Field::textarea('details'),
    Field::checkbox('available', ['Show in the shop']),
    Field::checkbox('payment', ['paypal', 'stripe', 'visa'], ['info' => 'Choose a payment solution.']),
    Field::radio('shipping', ['allow', 'disallow']),
    Field::select('area', [['Belgium', 'Luxembourg', 'England']]),
    Field::media('backcover'),
    Field::collection('images'),
    Field::infinite('chapters', [
        Field::text('title'),
        Field::textarea('resume'),
        Field::media('pic'),
        Field::collection('covers')
    ])
]);

Taxonomy::make('publisher', 'jl_books', 'Publishers', 'Publisher')->set()->bind();
Taxonomy::make('author', array('jl_books', 'post'), 'Authors', 'Author')->set()->bind();

Pronto::share('shared', array('a', 'b', 'c'));

Metabox::make('Informations', 'page', ['template' => 'custom-template'])->set([
    Field::text('page_subtitle', ['title' => 'Subtitle']),
    Field::color('page_bg', ['title' => 'Page color'])
]);