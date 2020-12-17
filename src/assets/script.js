var gee = window.gee || require('gene-event-handler').default
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import slick from 'slick-carousel'
import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'


gsap.registerPlugin(ScrollTrigger)

export default {
	name: 'custom ',

	init() {
		this.hook()
		$('.hasChild').on('click', function () {
			$(this).toggleClass('active')
		})
	},

	hook() {
		gee.hook('contackSubmit', me => {
			var g = $.fn.gene,
				f = me.data('ta') ? $('#' + me.data('ta')) : me.closest('form'),
				dAction = function () {
					me.removeAttr('disabled')
						.find('i')
						.remove()

					if (this.code == '1') {
						if (me.attr('reset') === '1') {
							f[0].reset()
						}

						if (g.isset(this.data.msg)) {
							g.alert({
								title: 'Alert!',
								txt: this.data.msg,
							})
						}

						if (g.isset(this.data.uri)) {
							location.href = this.data.uri === '' ? g.apiUri : this.data.uri
						}

						if (g.isset(this.data.goback)) {
							history.go(-1)
						}

						if (g.isset(this.data.reset)) {
							f[0].reset()
						}

						if (g.check(this.data.func)) {
							g.clog(this.data.func)
							g.exe(this.data.func, me)
						}
					} else {
						if (g.isset(this.data) && g.isset(this.data.msg)) {
							g.alert({
								title: 'Alert!',
								txt: this.data.msg,
							})
						} else {
							g.alert({
								title: 'Error!',
								txt: 'Server Error, Plaese Try Later(' + this.code + ')',
							})
						}
					}
				}

			f.find('input').each(function () {
				if ($(this).val() == $(this).attr('placeholder')) $(this).val('')
			})

			if (!f[0].checkValidity()) {
				console.log('html5 run')
				// return false;
			} else {
				me.event.preventDefault()
				me.attr('disabled', 'disabled').append(
					'<i class="fa fa-spinner fa-pulse fa-fw"></i>'
				)

				g.yell(me.data('uri'), f.serialize(), dAction, dAction)
			}
		})



		gee.hook('scrollTo', me => {
			const target = $(me.data('target'))

			var $body = window.opera ?
				document.compatMode == 'CSS1Compat' ?
					$('html') :
					$('body') :
				$('html,body')
			$body.animate({
				scrollTop: target.offset().top - 65,
			},
			800
			)
		})


		gee.hook('slider', me => {
			me.slick({
				dots: true,
				autoplay: false,
				autoplaySpeed: 4000,
				speed: 1200,
				arrows: false,
			})
		})


		gee.hook('slider-2', me => {
			me.slick({
				dots: true,
				autoplay: true,
				autoplaySpeed: 4000,
				speed: 1200,
				arrows: false,
				slidesToShow: 2,
				slidesToScroll: 2,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
				]
			})
		})


		gee.hook('slider-clients', me => {
			me.slick({
				dots: false,
				autoplay: true,
				autoplaySpeed: 0,
				speed: 1200,
				arrows: false,
				variableWidth: true,
				centerMode: true,
				easing: 'linear',
			})
		})
	},
}