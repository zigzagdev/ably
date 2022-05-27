.PHONY: setup
setup: ~/.php/

#~/.php/:
#	mkdir ~/.php/
#	echo export 'PATH=~/.php/current/bin:$PATH' >> ~/.bash_profile

.PHONY: ls
ls:
	@ls ~/.php/

.PHONY: install
install: ~/.php/$(version)

.PHONY: reinstall
reinstall: uninstall clean install

.PHONY: composer install
install: ~/.php/composer install
