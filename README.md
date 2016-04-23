# README

##将chrome书签整理成markdown格式。

随着书签里收藏的东西越来越多，慢慢的就变得杂乱无章了。因此，需要定时整理一下自己的书签，以便于清理出无效的或者分类不准确的收藏。

利用周末的时间，写了一个小小的PHP脚本。将自己的书签先导出成markdown格式的文件。

本示例仅以Mac OS 系统的chrome浏览器为例。

实际执行脚本的时候需要将书签根路径中的{User}替换成自己的真是用户名。

执行脚本：/usr/bin/php parseYourBookmarksToMarkdown.php

生成bookmarks.md 文件。

##注意：

如果运行出错，请注意提示，并根据提示加以调整。一般为书签文件路径不对。