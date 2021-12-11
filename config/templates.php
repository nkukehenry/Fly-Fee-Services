<?php
return [
    'calculation' => [
        'field_name' => [
            'title' => 'text',
            'short_description' => 'text',
            'button_name' => 'text',
            'button_link' => 'url',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_description.*' => 'required|max:250',
            'image.*' => 'nullable|max:5572|image|mimes:jpg,jpeg,png',
        ]
    ],

    'why-chose-us' => [
        'field_name' => [
            'title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],


    'app' => [
        'field_name' => [
            'title' => 'text',
            'short_description' => 'textarea',
            'app_link' => 'url',
            'playstore_link' => 'url',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_description.*' => 'required|max:1000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'way-to-send' => [
        'field_name' => [
            'title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],
    'send-money-video' => [
        'field_name' => [
            'title' => 'text',
            'short_details' => 'text',
            'youtube_link' => 'url',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_details.*' => 'required|max:100',
            'youtube_link.*' => 'required',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'testimonial' => [
        'field_name' => [
            'title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:200'
        ]
    ],


    'support' => [
        'field_name' => [
            'title' => 'text',
            'short_details' => 'textarea',
            'button_name' => 'text',
            'button_link' => 'url',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_details.*' => 'required|max:1000',
            'button_name.*' => 'required|max:100',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'faq' => [
        'field_name' => [
            'title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],


    'family-support' => [
        'field_name' => [
            'title' => 'text',
            'short_description' => 'text',
            'image' => 'file'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_description.*' => 'required|max:600',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],

    'blog' => [
        'field_name' => [
            'title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],

    'we-accept' => [
        'field_name' => [
            'title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],

    'news-letter' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000'
        ]
    ],

    'about-us' => [
        'field_name' => [
            'title' => 'text',
            'short_description' => 'textarea',
            'youtube_link' => 'url',
            'image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_description.*' => 'required|max:2000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ],
        'size' => [
            'image' => '465x465'
        ]
    ],

    'services' => [
        'field_name' => [
            'title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100'
        ]
    ],

    'mission-and-vision' => [
        'field_name' => [
            'title' => 'text',
            'description' => 'textarea',
            'image' => 'file'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'description.*' => 'required|max:3000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ],
        'size' => [
            'image' => '460x675'
        ]
    ],

    'form-right-content' => [
        'field_name' => [
            'details' => 'textarea',
            'button_name' => 'text',
            'button_link' => 'url',
        ],
        'validation' => [
            'details.*' => 'required|max:500',
            'button_name.*' => 'required'
        ]
    ],

    'contact-us' => [
        'field_name' => [
            'title' => 'text',
            'short_details' => 'text',
            'address' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'footer_left_text' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_details.*' => 'required|max:200',
            'address.*' => 'required|max:2000',
            'email.*' => 'required|max:2000',
            'phone.*' => 'required|max:2000',
            'footer_left_text.*' => 'required|max:2000',
        ]
    ],


    'message' => [
        'required' => 'This field is required.',
        'min' => 'This field must be at least :min characters.',
        'max' => 'This field may not be greater than :max characters.',
        'image' => 'This field must be image.',
        'mimes' => 'This image must be a file of type: jpg, jpeg, png.',
    ],
    'template_media' => [
        'image' => 'file',
        'small_image' => 'file',
        'thumbnail' => 'file',
        'youtube_link' => 'url',
        'button_link' => 'url',
        'button_link2' => 'url',
        'app_link' => 'url',
        'playstore_link' => 'url',
    ]
];
