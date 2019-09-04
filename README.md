Second Life Shinto shrine register (SLSR)
=========================================
[![Chat](https://discordapp.com/api/guilds/491727805885710336/widget.png?style=shield)](https://discord.gg/AeY5654)
[![All shrines](https://slsr.org/shrine-counter-badge.php?locale=en)](https://slsr.org/shrines)

About
-----
The Second Life Shinto Shrine Register (SLSR) is a association of Shinto shrines in Second Life.

Requirements
------------
* PHP 7
* php-xml
* php-gd
* php-gettext

Intall notes
------------
* The application needs write access for the directory `/public/images/shrines/small`.
* The shrine images in `/public/images/shrines` needs to have the complete shrine name, with underscores instead of spaces, as file name (expecting *.png files).
* Also the database structure from `/database/structure.sql` and the business data (see: https://github.com/sl-shinto-shrine-register/v1-data.git) needs to be imported.

License
-------
This project is free software under the terms of the GNU General Public License v3 as published by the Free Software Foundation.
It is distributed WITHOUT ANY WARRANTY (without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE).
For more details please see the LICENSE file or: http://www.gnu.org/licenses

Credits
-------
* Homepage: https://www.slsr.org
* Author: Vivien Richter <vivien@slsr.org>
* Git repository: https://github.com/sl-shinto-shrine-register/v1.git
