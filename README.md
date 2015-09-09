**THIS PLUGIN IS NOT MAINTAINED ANYMORE !**

# Configuration

Ce plugin symfony 1.4 fournit un thème d'administration avec son propre Admin Generator. Il peut être combiné avec le plugin [sfEPFactoryFormPlugin](http://www.symfony-project.org/plugins/sfEPFactoryFormPlugin).

## View.yml
Vous souhaitez utiliser ce thème sur toute votre application ou simplement un module ? Il vous suffit d'éditer (ou créer) le fichier _view.yml_ du répertoire _config_ de votre application ou module, et d'y appliquer l'un des layouts proposé par le plugin :

* admin : thème général avec le menu
* clean : thème réduit, pour l'authentification ou les pages d'erreur

Vous pouvez rajouter autant de thèmes que nécessaire afin de les prendre en compte par le plugin, cela chargera les javascripts et css nécessaires au plugin. Par exemple, pour rajouter un layout _fancybox_, éditer le fichier _app.yml_ :

    all:
      sf_admin_template:
        templates: [admin, clean, fancybox]

## Authentification
Afin de garder une homogénéité à travers toute l'administration, les templates du module [sfGuardAuth](http://www.symfony-project.org/plugins/sfDoctrineGuardPlugin) ont été surchargés. Pour cela, copiez le répertoire _/sfAdminTemplatePlugin/modules/sfGuardAuth_, et collez-le dans le répertoire _modules_ de votre application.

## Menu
Ce plugin vous permet d'intégrer dynamiquement un menu en haut du thème _admin_. Pour cela, éditer le fichier _app.yml_ :

    all:
      sf_admin_template:
        menus:
          article:
            label: Articles
            credentials: []
            route_prefix: article

* label [string, requis] : intitulé du lien dans le menu
* credentials [array, optionnel] : liste des credentials requises par l'utilisateur pour voir le lien
* route_prefix [string, optionnel] : url symfony (route_name, @route_name, action/module). par défaut, récupère le nom de menu ("article")

## Admin Generator
Un thème personnalisé d'admin generator est intégré à ce plugin. Pour le prendre en compte dans vos modules, éditez le fichier _generator.yml_ de votre module.

* Renseignez le paramètre _class_ par "sfAdminTemplateGenerator"
* Renseignez le paramètre _theme_ par "admin_template"
* Renseignez le bloc _show_ de la même manière que le bloc _list_, en renseignant les paramètres _title_ et _display_.

Il est possible d'utiliser un template en colonnes pour vos formulaire d'admin generator. Pour cela, renseignez les paramètres suivants :

* Ajouter un paramètre _template_ au contexte (form, edit, new), et renseignez-le avec "columns"
* Ajouter un paramètre _columns_ au contexte (form, edit, new), et renseignez-le avec la liste des champs présents dans la colonne de droite : [name, url]
* Renseignez le paramètre _display_ du contexte (form, edit, new) avec la liste des champs présents dans la colonne principale : [contents, description]

Exemple de _generator.yml_ :

    generator:
      class: sfAdminTemplateGenerator
      param:
        model_class:           Article
        theme:                 admin_template
        non_verbose_templates: true
        with_show:             false
        singular:              ~
        plural:                ~
        route_prefix:          article
        with_doctrine_route:   true
        actions_base_class:    sfActions

        config:
          actions: ~
          fields:  ~
          list:
            title: Article
          show:
            title: %%name%%
            display: [name, value, slug]
          filter:  ~
          form:
            template: columns
            display: [contents, description]
            columns: [name, url]
          edit:    ~
          new:     ~
