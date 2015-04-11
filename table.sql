CREATE TABLE IF NOT EXISTS gee_postback (
  gee_unique int(10) unsigned NOT NULL,
  gee_postback varchar(200) NOT NULL,
  gee_idapp int(10) unsigned NOT NULL,
  gee_app varchar(200) NOT NULL,
  gee_ppi decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  gee_currency char(3) NOT NULL DEFAULT 'USD',
  gee_country char(2) NOT NULL DEFAULT 'US',
  gee_lang char(2) NOT NULL DEFAULT 'EN',
  gee_iddevice int(10) unsigned NOT NULL,
  gee_device varchar(200) NOT NULL,
  gee_click int(10) unsigned NOT NULL,
  gee_installation int(10) unsigned NOT NULL,
  PRIMARY KEY (gee_unique),
  KEY gee_idapp (gee_idapp),
  KEY gee_ppi (gee_ppi),
  KEY gee_currency (gee_currency),
  KEY gee_country (gee_country),
  KEY gee_lang (gee_lang),
  KEY gee_iddevice (gee_iddevice),
  KEY gee_click (gee_click),
  KEY gee_installation (gee_installation)
) DEFAULT CHARSET=utf8;