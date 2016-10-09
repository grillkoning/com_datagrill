WELCOME TO DATAGRILL; TO BUILD A MYSQL FRONTEND IN JOOMLA! WITHOUT ANY CODING

(C) Chris Rutten 2016

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.


QUICKSTART GUIDE:

This programm is a Joomla! wrapper around the phenomenal Xataface platform. To get started:

(1) Install like any other Joomla! extension. For Help see the Joomla! documentation on:
https://docs.joomla.org/Installing_an_extension

(2) Create your first application in the administrator panel:
    - Choose 'components' -> 'Datagrill' -> 'application'
    - click 'new'
    - Enter the credentials needed for accesing your mySql database
    - click 'save'

(3) Setting credentials for your application
    - from within the same form as in (2), where you entered the credentials, choose the tab 'ACL'
    - choose the usergroup 'registered'
    - given them all the permissions listed, just to get started

(4) Adding tables to your application
    - Choose 'components' -> 'Datagrill' -> 'table'
    - enter the name (as it is known to the mySql database) into the 'title' field
    - Enter a human-readable alias into the 'description' field
    - Save and repeat as often as wanted

(5) To enable your application, create a new menu item of the type 'datagrill'. For help see the Joomla! documentation:
https://docs.joomla.org/Adding_a_new_menu_item

ENJOY!

WHAT'S NEXT:

You can customize your application in an unlimited number of ways. Its starting path is 
/components/com_datagrill/apps
See the documentation on Xataface.com:
http://xataface.com/documentation/tutorial/getting_started/using_first_app

note on customizing your application:
You can do just about anything xataface allows, except using its authentication / permissions functions; since this is already handled by Joomla



   


