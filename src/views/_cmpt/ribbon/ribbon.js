import './ribbon.scss'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

require('./ribbon.twig')

var gee = window.gee || $.fn.gene
window.gee = gee

gee.hook('ribbonAnimation', me => {
	const tl = gsap.timeline({ repeat: -1 })
	const w = me.width()
	console.log(w)

	tl.to(me.find('.mask'), 1, { x: '100%', ease: 'power2.easeInOut' }, 'go')
		.to(me.find('svg'), 1, { x: '-100%', ease: 'power2.easeInOut' }, 'go')
		.set(me.find('.mask'), { x: '-100%' })
		.set(me.find('svg'), { x: '100%' })
		.to(me.find('.mask'), 1, { x: '0%', ease: 'power2.easeInOut' }, 'go2')
		.to(me.find('svg'), 1, { x: '0%', ease: 'power2.easeInOut' }, 'go2')

	ScrollTrigger.create({
		animation: tl,
		trigger: me,
		// toggleActions: 'play pause resume reset',
		// end: '+=1600',
		// start: 'top top',
		// id:'ribbon',
		// markers: true,
	})
})
