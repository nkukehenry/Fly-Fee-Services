<?php

$arr = [
     'dashboard' => [
        'label' => "Dashboard",
        'access' => [
            'view' => ['admin.dashboard'],
            'add' => [],
            'edit' => [],
            'delete' => [],
        ],
    ],
    'manage_staff' =>[
        'label' => "Manage Staff",
        'access' => [
            'view' => ['admin.staff'],
            'add' => ['admin.storeStaff'],
            'edit' => ['admin.updateStaff'],
            'delete' => [],
        ],
    ],
    'identify_form' =>[
        'label' => "Identity Form",
        'access' => [
            'view' => ['admin.identify-form'],
            'add' => ['admin.identify-form.store'],
            'edit' => ['admin.identify-form.store'],
            'delete' => [],
        ],
    ],
    'remit_operation' => [
        'label' => "Remit operation",
        'access' => [
            'view' => [
                'admin.service',
                'admin.continent',
                'admin.country',
                'admin.country.service',
                'admin.country.service.charge',
                'admin.purpose',
                'admin.sourceOfFund',
            ],
            'add' => [
                'admin.store.service',
                'admin.store.continent',
                'admin.country.create',
                'admin.country.service.store',
                'admin.store.purpose',
                'admin.store.sourceOfFund',
            ],
            'edit' => [
                'admin.update.service',
                'admin.update.continent',
                'admin.country.edit',
                'admin.country.multiple-active',
                'admin.country.service.update',
                'admin.update.purpose',
                'admin.update.sourceOfFund',
            ],
            'delete' => [
                'admin.delete.service',
                'admin.delete.continent',
                'admin.delete.purpose',
                'admin.delete.sourceOfFund',
            ],
        ],
    ],
    'manage_coupon' => [
        'label' => "Manage Coupon",
        'access' => [
            'view' => [
                'admin.coupon',
                'admin.coupon.used',
                ],
            'add' => [
                'admin.coupon.store',
            ],
            'edit' => [],
            'delete' => [],
        ],
    ],
    'remittance_history' => [
        'label' => "Remittance History",
        'access' => [
            'view' => [
                'admin.money-transfer',
                'admin.money-transfer.complete',
                'admin.money-transfer.pending',
                'admin.money-transfer.cancelled',
                'admin.money-transfer.search',
                'admin.money-transfer.details',
            ],
            'add' => [],
            'edit' => [
                'admin.money-transfer.action'
            ],
            'delete' => [],
        ],
    ],
    'payment_gateway' => [
        'label' => "Payment Gateway",
        'access' => [
            'view' => [
                'admin.payment.methods',
                'admin.deposit.manual.index'
            ],
            'add' => [
                'admin.deposit.manual.create'
            ],
            'edit' => [
                'admin.edit.payment.methods',
                'admin.deposit.manual.edit'
            ],
            'delete' => [],
        ],
    ],
    'payment_log' => [
        'label' => "Payment Request & Log",
        'access' => [
            'view' => [
                'admin.payment.pending',
                'admin.payment.log',
                'admin.payment.search',
            ],
            'add' => [],
            'edit' => [
                'admin.payment.action'
            ],
            'delete' => [],
        ],
    ],

    'user_management' => [
        'label' => "User Management",
        'access' => [
            'view' => [
                'admin.users',
                'admin.users.search',
                'admin.email-send',
                'admin.users.loggedIn',
                'admin.user.transaction',
                'admin.user.fundLog',
                'admin.user.transfer',
                'admin.user.loggedIn',
            ],
            'add' => [],
            'edit' => [
                'admin.user-multiple-active',
                'admin.user-multiple-inactive',
                'admin.user-edit',
                'admin.send-email',
            ],
            'delete' => [],
        ],
    ],
    'transaction' => [
        'label' => "Transaction",
        'access' => [
            'view' => [
                'admin.transaction',
                'admin.transaction.search'
            ],
            'add' => [],
            'edit' => [],
            'delete' => [],
        ],
    ],
    'support_ticket' => [
        'label' => "Support Ticket",
        'access' => [
            'view' => [
                'admin.ticket',
                'admin.ticket.view',
            ],
            'add' => [
                'admin.ticket.reply'
            ],
            'edit' => [],
            'delete' => [
                'admin.ticket.delete',
            ],
        ],
    ],
    'subscriber' => [
        'label' => "Subscriber",
        'access' => [
            'view' => [
                'admin.subscriber.index',
                'admin.subscriber.sendEmail',
            ],
            'add' => [],
            'edit' => [],
            'delete' => [
                'admin.subscriber.remove'
            ],
        ],
    ],

    'website_controls' => [
        'label' => "Website Controls",
        'access' => [
            'view' => [
                'admin.basic-controls',
                'admin.color-settings',
                'admin.email-controls',
                'admin.email-template.show',
                'admin.sms.config',
                'admin.sms-template',
                'admin.notify-config',
                'admin.notify-template.show',
                'admin.notify-template.edit',
            ],
            'add' => [],
            'edit' => [
                'admin.basic-controls.update',
                'admin.color-settings.update',
                'admin.email-controls.update',
                'admin.email-template.edit',
                'admin.sms.config',
                'admin.sms-template.edit',
                'admin.notify-config.update',
                'admin.notify-template.update',
            ],
            'delete' => [],
        ],
    ],
    'language_settings' => [
        'label' => "Language Settings",
        'access' => [
            'view' => [
                'admin.language.index',
            ],
            'add' => [
                'admin.language.create',
            ],
            'edit' => [
                'admin.language.edit',
                'admin.language.keywordEdit',
            ],
            'delete' => [
                'admin.language.delete'
            ],
        ],
    ],
    'theme_settings' =>  [
        'label' => "Theme Settings",
        'access' => [
            'view' => [
                'admin.logo-seo',
                'admin.breadcrumb',
                'admin.template.show',
                'admin.content.index',
            ],
            'add' => [
                'admin.content.create'
            ],
            'edit' => [
                'admin.logoUpdate',
                'admin.seoUpdate',
                'admin.breadcrumbUpdate',
                'admin.content.show',
            ],
            'delete' => [
                'admin.content.delete'
            ],
        ],
    ],

];

return $arr;



