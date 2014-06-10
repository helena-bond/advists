<?php

class SyncController extends Controller
{

    public function actionUserdata()
    {
        $from = 0;
        $to = 3000;
        $criteria = new CDbCriteria;
        $criteria->addInCondition('meta_key',
                array('description', 'first_name', 'last_name', 'nickname', 'user_url'));
        $criteria->addBetweenCondition('user_id', $from, $to);
        
        $wp_meta = WPUsermeta::model()->findAll($criteria);
        
        $user_data = array();
        
        foreach($wp_meta as $meta) {
            if(!isset($user_data[$meta->user_id])) {
                $profile = Profile::model();
                $user_data[$meta->user_id]['profile'] = new Profile;
                
            }
        }
        
    }

    public function actionDelnone()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('role', User::ROLE_NONE);

        User::model()->deleteAll($criteria);
    }

    public function actionUser()
    {
        /* $from = 9001;
          $to = 12000;
          $criteria = new CDbCriteria;
          $criteria->addBetweenCondition('id', $from, $to);

          $users = User::model()->findAll($criteria);

          foreach($users as $user)
          {
          $criteria = new CDbCriteria;
          $criteria->compare('user_id', $user->id);
          $criteria->compare('meta_key', 'wp_user_level');

          $user_role = WPUsermeta::model()->find($criteria);
          if($user_role != null)
          {
          //$user->role = $user_role->meta_value;
          switch($user_role->meta_value) {
          case 10:
          $user->role = User::ROLE_ADMIN;
          break;
          case 7:
          $user->role = User::ROLE_MODER;
          break;
          case 2:
          $user->role = User::ROLE_AUTHOR;
          break;
          case 1:
          $user->role = User::ROLE_READER;
          break;
          default:
          $user->role = User::ROLE_NONE;
          }
          }
          else
          {
          $user->role = User::ROLE_NONE;
          }

          $user->create_at = strtotime($user->user_registered);
          $user->save(false);
          } */
    }

    public function actionPost()
    {
        /* $from = 12001;
          $to = 15000;

          $criteria = new CDbCriteria;
          $criteria->compare('post_status', 'publish');
          $criteria->compare('post_type', 'post');
          $criteria->addBetweenCondition('id', $from, $to);

          $wp_posts = WPPosts::model()->findAll($criteria);

          foreach($wp_posts as $wp)
          {
          $post = new Post;
          $post->author = $wp->post_author;
          $post->category = $wp->post_category;
          $post->comment_count = $wp->comment_count;
          $post->content = $wp->post_content;
          $post->date = strtotime($wp->post_date_gmt);
          $post->guid = $wp->guid;
          $post->modified = strtotime($wp->post_modified_gmt);
          $post->old_id = $wp->ID;
          $post->status = 'publish';
          $post->title = $wp->post_title;
          $post->save(false);
          } */
    }
    
    public function actionTags()
    {
        /*$from = 4001;
        $to = 4500;
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('t.term_id', $from, $to);
        $criteria->with = array('type');
        $criteria->together = true;

        $wp_terms = WPTerms::model()->findAll($criteria);
        foreach($wp_terms as $term) {
            if($term->type->taxonomy == 'category') {
                $category = new Category;
                $category->id = $term->term_id;
                $category->name = $term->name;
                $category->link = $term->slug;
                $category->parent_id = $term->type->parent;
                $category->save(false);
            } elseif($term->type->taxonomy == 'post_tag'){
                $tag = new Tag;
                $tag->id = $term->term_id;
                $tag->name = $term->name;
                $tag->link = $term->slug;
                $tag->save(false);
            }
            
        }*/
        
        /*$from = 3001;
        $to = 3500;
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('t.id', $from, $to);
        
        $posts = Post::model()->findAll($criteria);
        foreach($posts as $post) {
            $criteria = new CDbCriteria;
            $criteria->with = array('type', 'type.term');
            $criteria->together = true;
            $criteria->compare('t.object_id', $post->old_id);
            
            $wp_term_relationships = WPTermRelationships::model()->findAll($criteria);
            foreach($wp_term_relationships as $wptr) {
                if($wptr->type->taxonomy == 'category') {
                    $PC = new PostCategory;
                    $PC->category_id = $wptr->type->term_id;
                    $PC->post_id = $post->id;
                    $PC->save(false);
                } elseif($wptr->type->taxonomy == 'post_tag') {
                    $PT = new PostTag;
                    $PT->post_id = $post->id;
                    $PT->tag_id = $wptr->type->term_id;
                    $PT->save(false);
                }
            }
        }*/
    }
    
    public function actionPostlink()
    {
        /*$from = 2501;
        $to = 3000;
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('t.id', $from, $to);
        $criteria->with = array('wppost');
        $criteria->together = true;
        $posts = Post::model()->findAll($criteria);
        foreach($posts as $post) {
            $post->link = $post->wppost->post_name;
            $post->save(false);
        }*/
    }
    
    public function actionFanfiction()
    {
        /*$from = 2801;
        $to = 3000;
        $criteria = new CDbCriteria;
        $criteria->with = array('categories');
        $criteria->together = true;
        $criteria->addBetweenCondition('t.id', $from, $to);
        $models = Fanfiction::model()->findAll($criteria);
        $array = array();
        foreach($models as $model) {
            $cat = CHtml::listData($model->categories, 'id', 'id');
            if((!isset($cat[3227])) and (!isset($cat[368])) and (!isset($cat[748])) and (!isset($cat[3223])) and (!isset($cat[3228]))){
                $array[] = $model->title;
                $array[] = $cat;
                //$model->delete();
            }
        }
        H::p($array);*/
        
        /*$from = 2501;
        $to = 3000;
        $criteria = new CDbCriteria;
        $criteria->with = array('categories');
        $criteria->together = true;
        $criteria->addBetweenCondition('t.id', $from, $to);
        $models = Fanfiction::model()->findAll($criteria);
        foreach($models as $model) {
            foreach($model->categories as $category) {
                if($category->id != 3227) {
                    $cat = Fandom::model()->findByPk($category->id);
                    if($cat == null) {
                        $cat = new Fandom;
                        $cat->id = $category->id;
                        $cat->link = $category->link;
                        $cat->name = $category->name;
                        $cat->parent_id = (($category->parent_id != 3227) ? $category->parent_id : 0);
                        $cat->save(false);
                    }
                    
                    $ff = new FanfictionFandom;
                    $ff->fandom_id = $cat->id;
                    $ff->fanfiction_id = $model->id;
                    $ff->save(false);
                }
            }
        }*/

        $genres = array(
            'романтика',//'Romance',//'Романс','romanse',
            'ангст', //'агнст','Ангаст'
            'размышления',
            'стёб',
            'драма',
            //'монолог',
            'Экшн',//'live-action','Action','Экшн (action)','экшен',
            'флафф',//'Fluff','флаф',
            'ОС',
            'юмор',//'humor','Humour',
            'десфик',//'deathfic',
            'сонгфик',//'сонг-фик','Songfiс','Songfic','Sonfic',
            'Джен',//'General',
            'hurt/comfort',
            'UST',//'юст',
            'Слэш (яой)',//'слеш','yaoi','slash','яой','Слэш (яой','слеш(яой)',
            'мистика',
            'POV',
            'chanslash',
            'психоделика',//'psychodelic',
            //'эротика',
            'AU',
            'OOC',//'ООС','OOC',
            'love story',//'Лав Стори',
            'PWP',
            'BDSM',
            'ER (Established Relationship)',//'ER',
            'Даркфик',//'dark','Darkfic',
            'Трагедия',
            'Повседневность',
            'Занавесочная история',
            'Эксперимент',
            'пародия',
            'Ужасы',//'horror','хоррор',
            'Психология',//'psychology',
            'гет',
            'смарм',
            'приключения',//'adventure',
            'кроссовер',//'crossover',
            'RPS',
            'Ориджинал',//'original','оридженл','ориджинл','оридж','ориджинел',
            'фем-слэш',
            'Ваниль',
            'пре-слэш',
        );
        $size = array(
            'Фиклет', //'Ficlet',
            'Виньетка',
            'мини', //'минифик',
            'Зарисовка',
            'драббл',//'длаббл','drabble','drubble',
            'роман',//'роман','pоман',
            'макси',
            'миди',
        );
        $raiting = array(
            'PG-15', //'РG-15', 'PG–15', 
            'PG-13', //'PG–13', 'NC-13', 'PG-12', 'РG-13', 
            'PG', //'РG',
            'R', 
            'G', 
            'NC-17', //'NС-17', 'PG-17', 'NC-18'
            'NC-21', 
        );
        $stopwords = array(
            'Фанфик','Monocrhrome Factor: Смерти нет','Monochrome Factor: Смерти нет',
            'Kuroshitusji','trinity blood','БАК','Loveless: Restless',
            'Monocrhrome Factor','death note','yami no matsuei',
            'Monochrome Factor: Благими намерениями…','j-rock','the Gazette',
            'girugamesh','Pencillin','code geass','junjou romantica',
            'gravitation','Gackt Job','Kiyoshi the Mad Beaver','PENICILLIN',
            'hyde','An Cafe','Antic Cafе','SID','vignettes',
            ////////
            'The Flare',
            'PSCompany', 'vampires','Node of Scherzo','Moi dix Mois',
            'LAREINE','HIZAKI grace project',"L'Arc~en~Ciel",'Due le Quartz',
            'Spread Beaver','S.K.I.N.','POV Масы','POV Ю','POV Гакта',
            'POV Мураки','GacktJOB','d.gray-man','Versailles -PQ-',
            'devil may cry','Tsubasa Resrvoir Chronicle','D.Gray Man',
            'D18', '1869', 'XS', '8059', '27all', '6918', 'X27', '5980', '27',
            'Фанфик: Devil May Cry','Перевод: Хелл-сама','ritsu',
            'TYL! 8059','Agat','Deatn Note','ЧО','Kuroshitsuji II',
            'Monoshitsuji','Gackt','xxxHolic','стих','KHR!','иллюзия жизни',
            'gundam seed','Gundam Seed Destiny','Warcraft 3','общий',
            'The Most Beautiful Death In The World','Maliсe Mizer',
            '2011','Axis Powers Hetalia','ККМ','Ориджинал','WoW',
            'D’espairsRay','Ван Пис','Табуретка/Шляпа','An Cofe',
            'Dir an Grey','Любовь сквозь время','Blood+: Истории дано продолжение',
            'diyaco','ЗоСан','black butler','почти сонгфик','POV Mana',
            'Перевод: Signore Satoshi','Hidurashi no naku koro ni',
            'naruro','gen','TYL!6918','Uraboku','27100','JRock','Данте/доппельгангер',
            'спорт','твинцест','Gazette','POV Грелля','Закончен','лаванда',
            'Фанфик j-rock','ОЖП','Нецензурная лексика','warcraft',
            'Смерть персонажа','Reita/doll','Aoi/doll','OMP/Uruha','автор:Versus King',
            'м/м','м/ж','Грег/Мик','Kuroshitsuj', //'авторы: Versus King & CAZADOR',
            'Изандрилл/Тай','fanfic','OC','собачье сердце','хомсики',
            'Код Гиасс','СПК','Размер: мини','Грейпфрут','DD','автор: Chihiro',
            'World of Warcraft Cataclysm','K-POP','DR2','Tiger and Bunny','ОМП',
            'DmC','Новый год','елка.','Артём/Саша','Терра\Терон','Тифа',
            'Скволл','Лайтинг/ Клауд','Крейг','Кефка Паллацо','Космос',
            'Хаос','Ультемеция','Гараланд','Облако Тьмы','Изнасилование (упоминанием)',
            'Омегаверс','Сакае/Нориаки',
            
            'Subtext','трагикомедия','хэппи-энд','фэнтези','сенен-ай','Трэш',
            'kink','киберпанк','сёнэн-ай','файтинг','приквел','детектив','мпрег',
            'comfort','MPEG','стихотворение','сказка','Философия','Hurt',
            'энгсти-флафф','loveletter','лирика','рассказ','Фэнтази','Драмма',
            'Фантастика','стихи','монолог','эротика'
        );
        
        $all_fandoms = CHtml::listData(Fandom::model()->findAll(), 'id', 'name');
        $all_authors = CHtml::listData(Author::model()->findAll(), 'id', 'name');
        $all_characters = CHtml::listData(Character::model()->findAll(), 'id', 'name', 'fandom_id');
        $all_genres = CHtml::listData(Genre::model()->findAll(), 'id', 'name');
        $all_raitings = CHtml::listData(Raiting::model()->findAll(), 'id', 'name');
        $all_sizes = CHtml::listData(Size::model()->findAll(), 'id', 'name');
        
        $oc = array('Все','ОС','ОЖП','ОМП','БАК');
        //Список *-потереть,
        $i = 26;
        $step = 100;
        $from = ($i*$step)+1;
        $to = ($i+1)*$step;
        $criteria = new CDbCriteria;
        $criteria->with = array('tags', 'fandoms');
        $criteria->together = true;
        $criteria->addBetweenCondition('t.id', $from, $to);
        $models = Fanfiction::model()->findAll($criteria);
        $array = array();
        foreach($models as $model) {
            $tags = CHtml::listData($model->tags, 'id', 'name');
            $fandoms = CHtml::listData($model->fandoms, 'id', 'name');
            $r = array();
            $a = array();
            $f = array();
            $g = array();
            $s = array();
            $pr = array();
            $ch = array();
            foreach($tags as $key => $tag) {
                if(self::in_array($tag, $raiting)) { //Рейтинг
                    $r[$key] = $tag;
                    unset($tags[$key]);
                } elseif(self::in_array($tag, $all_fandoms)) { //Фандом
                    $f[$tag] = $tag;
                    unset($tags[$key]);
                } elseif(strripos($tag, "Автор") !== false) { //Автор //Йоджи_Зеро & Lora316
                    $tmp = explode(':', $tag);
                    $tmp = explode(',', trim($tmp[1]));
                    foreach($tmp as $t) {
                        $a[$key] = $t;
                    }
                    unset($tags[$key]);
                } elseif(self::in_array($tag, $genres)) { //Жанры
                    $g[$key] = $tag;
                    unset($tags[$key]);
                } elseif(self::in_array($tag, $size)) {
                    $s[$key] = $tag;
                    unset($tags[$key]);
                }
                elseif(in_array($tag, $stopwords)) { //Стопслова
                     //unset($tags[$key]);
                } else {
                    $tmp = preg_split("/( х |\/|\\\\|\|)/", $tag);
                    foreach($tmp as $t) {
                        $ch[$t] = trim($t);
                        $pr[$key][] = trim($t);
                    }
                    //Будем хранить пейринги как fanfiction_id json(pairings)
                    unset($tags[$key]);
                }
            }
            /*foreach($ch as $k => $v) {
                if($k=='Gackt') $ch[$k] = 'Гакт';
            }*/
            $array[] = array(
                'title' => $model->title,
                'id' => $model->id,
                'r' => $r,
                'fandoms' => $fandoms,
                'f' => $f,
                'a' => $a,
                'g' => $g,
                's' => $s,
                'pr' => $pr,
                'ch' => $ch,
                'tags' => $tags
            );
        }
        //H::p($array);
        foreach($array as $item) {
            H::p($item, false);
            //fandom
            if(count($item['f']) > count($item['fandoms'])) {
                $diff = array_diff($item['f'], $item['fandoms']);
                foreach($diff as $f) {
                    $fandom = array_search($f, $all_fandoms);
                    if($fandom === false) {
                        $_fandom = new Fandom;
                        $_fandom->name = $f;
                        $_fandom->save(false);
                        $fandom = $_fandom->id;
                        $all_fandoms[$fandom] = $f;
                        $item['fandoms'][$fandom] = $f;
                    }
                    $ff = new FanfictionFandom;
                    $ff->fandom_id = $fandom;
                    $ff->fanfiction_id = $item['id'];
                    $ff->save(false);
                }
            }
            //raiting
            foreach($item['r'] as $r){
                $rait = array_search($r, $all_raitings);
                if($rait === false) {
                    $new_raiting = new Raiting();
                    $new_raiting->name = $r;
                    $new_raiting->save(false);
                    $rait = $new_raiting->id;
                    $all_raitings[$rait] = $r;
                }
                $fr = new FanfictionRaiting;
                $fr->fanfiction_id = $item['id'];
                $fr->raiting_id = $rait;
                $fr->save(false);
            }
            //author
            foreach($item['a'] as $a) {
                $auth = array_search($a, $all_authors);
                if($auth === false) {
                    $new_author = new Author();
                    $new_author->name = $a;
                    $new_author->save(false);
                    $auth = $new_author->id;
                    $all_authors[$auth] = $a;
                }
                $fa = new FanfictionAuthor;
                $fa->fanfiction_id = $item['id'];
                $fa->author_id = $auth;
                $fa->save(false);
            }
            //genre
            foreach($item['g'] as $g) {
                $genr = array_search($g, $all_genres);
                if($genr === false) {
                    $new_genre = new Genre;
                    $new_genre->name = $g;
                    $new_genre->save(false);
                    $genr = $new_genre->id;
                    $all_genres[$genr] = $g;
                }
                $fg = new FanfictionGenre;
                $fg->fanfiction_id = $item['id'];
                $fg->genre_id = $genr;
                $fg->save(false);
            }
            //size
            foreach($item['s'] as $s) {
                $siz = array_search($s, $all_sizes);
                if($siz === false) {
                    $new_size = new Size();
                    $new_size->name = $s;
                    $new_size->save(false);
                    $siz = $new_size->id;
                    $all_sizes[$siz] = $s;
                }
                $fs = new FanfictionSize();
                $fs->fanfiction_id = $item['id'];
                $fs->size_id = $siz;
                $fs->save(false);
            }
            //characters
            $f_char = array();
            foreach($item['ch'] as $ch){
                //$char = array_search($ch, $all_characters);
                $char = self::search_character($ch, $item['fandoms'], $all_characters);
                if($char === false) {
                    $_char = new Character;
                    if(count($item['fandoms']) > 0) {
                        $_char->fandom_id = array_search(array_shift(array_values($item['fandoms'])), $all_fandoms);
                    } else {
                        $_char->fandom_id = 0;
                    }
                    $_char->name = $ch;
                    $_char->save(false);
                    $char = $_char->id;
                    $all_characters[$_char->fandom_id][$char] = $ch;
                }
                $fch = new FanfictionCharacter;
                $fch->character_id = $char;
                $fch->fanfiction_id = $item['id'];
                $fch->save(false);
                $f_char[$ch] = $char;
            }
            //pairings
            foreach($item['pr'] as $pr) {
                $fpr = new FanfictionPairing;
                $fpr->fanfiction_id = $item['id'];
                $pairing = array();
                foreach($pr as $ch) {
                    $pairing[] = $f_char[$ch];
                }
                $fpr->pairing = CJSON::encode($pairing);
                $fpr->save(false);
            }
            //tag
            foreach($item['tags'] as $id => $t) {
                $ft = new FanfictionTag;
                $ft->fanfiction_id = $item['id'];
                $ft->tag_id = $id;
                $ft->save(false);
            }
        }
    }
    
    public static function in_array($needle, $haystack) 
    {
     return in_array( strtolower($needle), array_map('strtolower', $haystack) );
    }
    
    public static function search_character($character, $fandoms, $array)
    {
        if(count($array) < 1) return false;
        foreach($fandoms as $key => $value){
            if(count($array[$key]) < 1) continue;
            $ch = array_search($character, $array[$key]);
            if($ch != false) {
                return $ch;
            }
        }
        foreach($array as $fandom => $values) {
            foreach($values as $key => $value) {
                if(strtolower($character) == strtolower($value)){
                    return $key;
                }
            }
        }
        return false;
    }
    
    public function actionCharacters()
    { //первое верное, второе надо заменить
        $array = array(
            /*1015 => 1021,
            1018 => 1023,
            1019 => 1022,
            1014 => 1020,
            63 => array(
                21, 804, 45
            ),
            350 => array(
                54, 62
            ),
            488 => 922,
            68 => array(
                34, 24
            ),
            365 => array(
                26
            ),
            69 => array(
                492, 459, 65
            ),
            353 => array(
                60, 351
            ),
            1419 => array(
                29
            ),
            354 => 1132,
            366 => array(
                454, 1251
            ),
            22 => 46,
            697 => 453,
            408 => 367,
            458 => array(
                35, 64
            ),
            1421 => 926,
            407 => 563,
            1261 => 491,
            1004 => array(
                1090, 1041, 
            ),
            1044 => 1043,
            1003 => 1091,
            1394 => 1170,
            701 => 307,
            681 => 319,
            702 => 323,
            305 => 322,
            682 => array(
                306, 342
            )*/
            25 => 924,
        );
        
        $characters = CHtml::listData(Character::model()->findAll(), 'id', 'thisModel');
        
        foreach($array as $key => $value) {
            if(!is_array($value)) {
                $array[$key] = array($value);
                $value = $array[$key];
            }
            foreach($value as $id) {
                $characters[$id]->parent_id = $key;
                $characters[$id]->save(false);
            }
        }
        
        /*$characters = CHtml::listData(Character::model()->findAll(), 'id', 'thisModel');
        $cf = CHtml::listData(FanfictionCharacter::model()->findAll(), 'id', 'thisModel', 'character_id');
        $pairings = FanfictionPairing::listData();
        
        foreach($array as $key => $value) {
            if(is_array($value)) {
                foreach($value as $id)
                {
                    //Заменяем в cf
                    if(isset($cf[$id])) {
                        foreach($cf[$id] as $_id => $_value)
                        {
                            $cf[$id][$_id]->caracter_id = $key;
                        }
                    }
                    
                    //заменяем в pairings
                    if(isset($pairings[$id])) {
                        foreach($pairings[$id] as $_id => $_value) {
                            
                        }
                    }
                    
                    if(isset($characters[$id])) {
                        $characters[$id]->delete();
                    }
                }
            }
        }*/

        //check for pairing
        //1344, 1345
    }
    
    public function actionTagc()
    {
        $bad = array(
            33
        );
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.id', $bad);
        $characters = Character::model()->findAll($criteria);
        
        //$criteria = new CDbCriteria;
        //$criteria->addInCondition('t.character_id', $bad);
        //$fc = FanfictionCharacter::model()->findAll($criteria);
        
        //$names = CHtml::listData($characters, 'id', 'name');
        //$criteria = new CDbCriteria;
        //$criteria->addInCondition('t.name', $names);
        //$tags = Tag::model()->findAll($criteria);
        
        foreach($characters as $c){
            //$tag = Tag::model()->findByAttributes(array('name' => $c->name));
            H::p($c->id, false);
            $criteria = new CDbCriteria;
            $criteria->compare('character_id', (int)$c->id);
            $fc = FanfictionCharacter::model()->findAll($criteria);
            $criteria = new CDbCriteria;
            $criteria->compare('t.pairing', $c->id, true);
            $fp = FanfictionPairing::model()->findAll($criteria);
            //H::p($fc, false);
            //H::p($fp, false);
            foreach($fc as $id => $_fc) {
                $fc[$id]->delete();
                echo 'deleted '.$_fc->character_id.'<br/>';
            }
            
            foreach($fp as $key=> $pairing) {
                foreach($pairing->characters as $_ch) {
                    var_dump(in_array($_ch->id, $bad));
                    if(in_array($_ch->id, $bad)) {
                        $fp[$key]->delete();
                        echo 'deleted '.$_ch->id.'<br/>';
                        continue;
                    }
                }
            }
            

            echo 'deleted '.$c->id.'<br/>';
            $c->delete();
            
            
        }
        
    }
    
    

}
