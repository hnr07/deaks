<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Команды GIT");
?><style>
.git_help {
	position:relative;
}
.git_help .text_copy {
	position:absolute;
	padding:5px 10px;
	border:solid 1px #888;
	background-color:#b2b2b2;
	border-radius: 15px 15px 15px 0px;
	display:none;
}
.git_help p .command {
	font-size:120%;
}
.git_help p .note {
	font-style: oblique;
	color:#888;
}
</style>
<script>

$(document).ready(function() {
	$(".git_help p").on("click", ".command", function(){
		var r = document.createRange();
		r.selectNode(this);
		
		document.getSelection().addRange(r);
		document.execCommand("copy");
		$(".git_help .text_copy").css({"display":"block"});
		 setTimeout( function(){$(".git_help .text_copy").css({"display":"none"});},3000);
	});

	$(".git_help").on("click",function(e) {
	  var offset = $(this).offset();
	  var relativeX = (e.pageX - offset.left);
	  var relativeY = (e.pageY - offset.top);
	 $(".git_help .text_copy").css({"left":(relativeX)+"px","top":(relativeY-45)+"px"});
	  
	});
})
</script>
<div class="git_help">
	<div class="text_copy"><div></div>Скопировано в буфер</div>
	
	<p><span class="note">Скачать GIT можно здесь</span> <a href="https://gitforwindows.org/" target="_blank">gitforwindows.org</a><br><br></p>
	
	
	<p><span class="command">mkdir test  </span><span class="note"> -  создать папку test</span></p>
	<p><span class="command">cd test  </span><span class="note"> -  войти в папку test</span></p>
	<p><span class="command">touch test.html   </span><span class="note"> -  создать файл test.html</span></p>

	<p><span class="command">git init </span><span class="note"> -  создать git-репозиторий из текущей папки</span></p>
	<p><span class="command">git config --global user.name "Smit" </span><span class="note"> -  Имя автора коммита, если указана опция --global действует для всей системы </span></p>
	<p><span class="command">git config --global user.email smit@mail.com </span><span class="note"> -  email автора коммита, если указана опция --global действует для всей системы </span></p>
	<p><span class="command">git config </span><span class="note"> -  проверить используемую конфигурацию</span></p>
	<p><span class="command">git config user.name </span><span class="note"> -  проверить значение конкретного ключа</span></p>
	<p><span class="command">git config --global core.autocrlf false </span><span class="note"> -  в паре со следующей командой отключить проверку формата</span></p>
	<p><span class="command">git config --global core.safecrlf false </span><span class="note"> -  в паре с предыдущей командой отключить проверку формата</span></p>

	<p><span class="command">git add test.html </span><span class="note"> -  добавит файл test.html на коммит кандидат, индексация файла</span></p>
	<p><span class="command">git add * </span><span class="note"> -  добавит все файлы на коммит кандидат, индексация всех файлов</span></p>
	<p><span class="command">git add . </span><span class="note"> -  добавит все файлы из текущей папки на коммит кандидат, индексация всех файлов из текущей папки</span></p>
	<p><span class="command">git add --all </span><span class="note"> -  добавит все файлы из текущей папки и подпапок на коммит кандидат, индексация всех файлов из текущей папки и подпапок</span></p>
	<p><span class="command">git reset HEAD test.html </span><span class="note"> -  исключить файл test.html из индекса</span></p>
	<p><span class="command">git rm test.html </span><span class="note"> -  удалить файл test.html </span></p>
	<p><span class="command">git mv test.html test.txt </span><span class="note"> -  переименовать файл "test.html" в "test.txt"</span></p>
	<p><span class="command">git checkout -- test.html </span><span class="note"> -  отмена изменений файла test.html (! нет обратного действия)</span></p>
	<p><span class="command">git diff </span><span class="note"> -  что изменили, но пока не проиндексировали</span></p>
	<p><span class="command">git diff --cached </span><span class="note"> -  что проиндексировали и что войдёт в следующий коммит</span></p>
	<p><span class="command">git diff --staged </span><span class="note"> -  сравнивает индексированные изменения с последним коммитом</span></p>

	<p><span class="command">git commit -m "First Commit" </span><span class="note"> -  добавит коммит из кандитатов в кавычках наименование коммита</span></p>
	<p><span class="command">git commit --amend </span><span class="note"> -  отмена последнего коммита</span></p>
	<p><span class="command">git commit -a -m 'Name Commit'  </span><span class="note"> -  индексация всех файлов и добавление коммита, можно обойтись без git add</span></p>

	<p><span class="command">git status </span><span class="note"> -  текущее состояние репозитория</span></p>
	<p><span class="command">git log </span><span class="note"> -  история репозитория</span></p>
	<p><span class="command">git log --pretty=oneline </span><span class="note"> -  история репозитория коммит в одну строку</span></p>
	<p><span class="command">git log --pretty=oneline --all </span><span class="note"> -  история репозитория все коммиты в одну строку</span></p>
	<p><span class="command">git log --max-count=3 </span><span class="note"> -  история репозитория 3 последних коммита</span></p>
	<p><span class="command">git log --author="test" </span><span class="note"> -  история репозитория по автору "test"</span></p>
	<p><span class="command">git log --pretty=format:"%h - %s : %ad [%an]" </span><span class="note"> -  история репозитория по своему формату %h-короткий хеш, %s-комментарий, %ad-дата, %an-автор</span></p>
	<p><span class="command">git log --date=short </span><span class="note"> -  история репозитория с короткой датой</span></p>

	<p><span class="command">git checkout d917d0b21e071bbe9bcbd0abd96586eaef4397a0 </span><span class="note"> -  откатить к хешу № d917d0b21e071bbe9bcbd0abd96586eaef4397a0</span></p>

	<p><span class="command">git reset HEAD test.txt </span><span class="note"> - вернуть состояние файла, ветки, коммита HEAD-к началу или к  хешу</span></p>
	<p><span class="command">git revert HEAD --no-edit </span><span class="note"> -  удаление коммита HEAD- последнего или до хеша</span></p>
	<p><span class="command">gitk </span><span class="note"> -  открыть редактор по умолчанию</span></p>

	<p><span class="command">git branch testing </span><span class="note"> -  создать ветку под названием testing</span></p>
	<p><span class="command">git checkout testing </span><span class="note"> -  перейти на ветку под названием testing</span></p>
	<p><span class="command">git checkout -b testing </span><span class="note"> -  создать и сразу перейти на ветку под названием testing</span></p>
	<p><span class="command">git checkout master </span><span class="note"> -  перейти на ветку по умолчанию под названием master</span></p>
	<p><span class="command">git branch -d testing </span><span class="note"> -  удалить ветку под названием testing(не удалится, если есть наработки)</span></p>
	<p><span class="command">git branch -D testing </span><span class="note"> -  удалить ветку под названием testing с потерей наработок</span></p>
	<p><span class="command">git merge testing </span><span class="note"> -  слить ветку под названием testing с текущей веткой</span></p>
	<p><span class="command">git branch </span><span class="note"> -  простой список имеющихся веток (* - текущая ветка)</span></p>
	<p><span class="command">git branch -v </span><span class="note"> -  последний коммит на каждой из имеющихся веток (* - текущая ветка)</span></p>
	<p><span class="command">git branch --merged </span><span class="note"> -  список веток слитых с текущей (* - текущая ветка)</span></p>
	<p><span class="command">git branch --no-merged </span><span class="note"> -  список веток не слитых с текущей (* - текущая ветка)</span></p>

	<p><span class="command">git remote add origin https: github.com/login/name_repository.git </span><span class="note"> -  связать локальный репозиторий с репозиторием на GitHub(origin)</span></p>
	<p><span class="command">git push origin master </span><span class="note"> -  обновить данные(master) в удаленном репозитории(origin)</span></p>
	<p><span class="command">git clone https:github.com/login/name_repository.git </span><span class="note"> -  Клонирование репозитория</span></p>
	<p><span class="command">git pull origin master </span><span class="note"> -  Запрос изменений с сервера</span></p>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>