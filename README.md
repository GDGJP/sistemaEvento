GDG Sistema de Eventos 
===========
pt-br
------------
GDG Sistema de Eventos é uma ferramenta que facilita o planejamento dos eventos e integrada com o seu site do GDG. Nosso objetivo é construir um recurso para desenvolvedores que querem ter mais facilidade de planejar seus eventos, gerar certificados, abrir inscrições e muitos mais.

GDG Event System is a tool that facilitates the planning of events and integrated with your website GDG. Our goal is to build a resource for developers who want to more easily plan your events, generate certificates, open registration of persons and many more.
--------
Login: admin@email.com / Key: 123
--------
<br />
Organização das pastas / Organization:
------------

```
  | .settings
  | arquivos	(Bootstrap)
  | components (Parte de configuração do sistema)
  | controllers (Controllers)
  | css
  | db (Script do banco)
  | views (Templates do site)
  | opix (Sistema Administrativo)
   \ 
    | DataTables-1.9.4
    | blueimp
    | ckeditor
    | colorpicker
    | components (Parte de configuração para o Administrador)
    | conexao	(Conexão com o banco usando PDO)
    | controllers (Controllers)
    | css
    | font
    | formbuilder
    | imagens_evento
    | images
    | img
    | jquery.jqGrid-4.5.2
    | jqueryui
    | js
    | models (Models)
    | scripts
    | styles
    | views (Telas e template do Administrador)
```

Configuração / Configuration
------------
<br />
Setar a base url apontando para a raiz do sistema nos seguintes arquivos:
<br />
```
1 - /Components/Configuracao.php
2 - /js/contaBancaria.js
3 - /js/evento.js
4 - /js/scripts.js
5 - /ckeditor/config.js
```


Lançamento / Release status
--------------
O projeto foi criado para suprir necessidades dos nossos eventos, com o lançamento de uma V1.0 em 20 de Agosto de 2014. 

The project was soft launched with a formal v1 launch in August 20, 2014.. 


Technology
----------
Código feito em PHP OO (com Orientação a Objetos) formato MVC

Code created with PHP OO (Object Orientation) format MVC



Contribuindo / Contributing
------------

GDG System Event is an open source project and we welcome your contributions! 
Before submitting a pull request, please review [CONTRIBUTING.md](CONTRIBUTING.md)
and make sure that there is an issue filed describing the fix or new content.
If you don't complete these steps, we won't be able to accept your pull request, sorry.



Linguagem / Language
=============================
A base do conteúdo é em Português-Brasil - Pt-br

The base content is in Pt-br.


<h2>Licença / License</h2>


                    GNU GENERAL PUBLIC LICENSE
                       Version 2, June 1991

    Copyright (C) 1989, 1991 Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
    Everyone is permitted to copy and distribute verbatim copies
    of this license document, but changing it is not allowed.at

       http://www.gnu.org/licenses/gpl-2.0.txt

   

