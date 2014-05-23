SELECT a.*, SUM(b.home) as home, b.language, l.image, l.sef, l.title_native FROM iuz6l_menu_types as a LEFT JOIN iuz6l_menu as b ON b.menutype = a.menutype AND b.home != 0 LEFT JOIN iuz6l_languages as l ON l.lang_code = b.language WHERE (b.client_id = 0 OR b.client_id IS NULL) GROUP BY a.id, a.menutype, a.description, a.title, b.menutype, b.language, l.image, l.sef, l.title_native