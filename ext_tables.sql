#
# Table structure for table 'tx_cardslider_domain_model_card'
#
CREATE TABLE tx_cardslider_domain_model_card (
    title varchar(255) NOT NULL DEFAULT '',
    description text,
    image int(11) unsigned NOT NULL DEFAULT '0',
    link varchar(500) NOT NULL DEFAULT '',
    link_text varchar(100) NOT NULL DEFAULT '',
    sorting int(11) DEFAULT '0',
    categories int(11) DEFAULT '0'
);

#
# Table structure for table 'tx_cardslider_domain_model_slider'
#
CREATE TABLE tx_cardslider_domain_model_slider (
    title varchar(255) NOT NULL DEFAULT '',
    cards int(11) unsigned NOT NULL DEFAULT '0',
    autoplay tinyint(1) unsigned DEFAULT '0',
    show_arrows tinyint(1) unsigned DEFAULT '1',
    show_dots tinyint(1) unsigned DEFAULT '1',
    slide_duration int(11) DEFAULT '5000',
    animation_type varchar(50) NOT NULL DEFAULT 'slide',
    categories int(11) DEFAULT '0'
);

#
# Table structure for table 'tx_cardslider_slider_card_mm'
#
CREATE TABLE tx_cardslider_slider_card_mm (
    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid_local,uid_foreign),
    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);