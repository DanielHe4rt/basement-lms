<?php
return [
    'general' => [
        'title' => 'Seus Cursos',
        'newCourse' => 'Novo Curso',
        'empty' => 'Parece que você não tem nenhum curso cadastrado.',
        'card' => [
            'status' => [
                'published' => 'Publicado',
                'sketch' => 'Rascunho',
            ],
            'monetize' => [
                'paid' => 'Pago',
                'free' => 'Grátis'
            ],
            'students' => 'Número de inscritos: :number',
            'monthlyStudents' => 'Número de inscritos do mês: :number',
            'stars' => 'Classificação do curso',
            'actions' => [
                'manage' => 'Gerenciar',
                'delete' => 'Apagar'
            ]
        ]
    ],
    'manage' => [
        'title' => 'Gerenciar Curso',
        'form' => [
            'title' => [
                'field' => 'Titulo',
                'placeholder' => 'Crie um titulo maneiro para o seu curso'
            ],
            'subtitle' => [
                'field' => 'Subtitulo',
                'placeholder' => 'Descreva em poucas palavras o que você irá ensinar no seu curso'
            ],
            'description' => [
                'field' => 'Descrição',
                'placeholder' => 'Deixe todos os detalhes do que irá ser ensinar no seu curso'
            ],
            'paid' => [
                'true' => 'Pago',
                'false' => 'Grátis'
            ],
            'level' => [
                'field' => 'Selecione o nível do curso',
                'beginner' => 'Iniciante',
                'intermediate' => 'Intermediário',
                'advanced' => 'Avançado'
            ],
            'cover' => 'Faça o upload da imagem do seu curso aqui. Ela deve atender aos nossos padrões de qualidade da imagem do curso para ser aceita. Diretrizes importantes: ter 750 x 422 pixels, estar no formato .jpg, .jpeg ou .png. e não ter nenhum texto na imagem.',
            'submit' => 'Submit'
        ]
    ]
];
