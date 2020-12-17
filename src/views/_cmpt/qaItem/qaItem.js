import './qaItem.scss'

var gee = window.gee || $.fn.gene
window.gee = gee

gee.hook('onQaClick', me => {
	me.toggleClass('active')
})