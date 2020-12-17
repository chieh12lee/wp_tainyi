import $ from 'jquery'
window.apiUrl = window.location.protocol + '//' + window.location.host + '/api'
window.publicUrl = '/app/themes/'

// import 'gene-event-handler/app/scripts/validatr.js'
import gee from 'gene-event-handler'
window.gee = gee

// 主要入口 載入 包含組件  自己 THEME 等等所有scss
// import '@/assets/tailwind.hochih.css'

//載入core的樣式  也載入了wc 的樣式 因為要繼承

import '@/assets/styles/core.scss'

// Hide Page Loader when DOM and images are ready
import LazyLoad from 'lazyload/lazyload'
new LazyLoad(document.querySelectorAll('.lazy'))

if (app.platform === 'IOS' && app.screen === 'mobile') {
	$('a').on('touchend', function(e) {
		$(this).click()
	})
}

import '@cmpt/steps/steps.js'
import '@cmpt/wrap/wrap.js'
import '@cmpt/banner/banner.js'
import '@cmpt/list/list.js'
import '@cmpt/carou/carou.js'
import '@cmpt/appbar/appbar.js'
import '@cmpt/share/share.js'
import '@cmpt/touch/touch.js'
import '@cmpt/ribbon/ribbon.js'
import '@cmpt/qaItem/qaItem.js'

import custom from '@/assets/script.js'
// import '@core/cmpt/comment/comment.js'

import app from '@core/mod/app.js'
import loader from '@core/mod/loader/loader.js'

// import Overlay from '@core/mod/overlay/overlay.js'
import Drawer from '@core/mod/drawer/drawer.js' 
// import mdForm from '@core/mod/form/form.js'
// import notice from '@core/mod/notice/notice.js'
// import scroll from '@core/mod/scroll/scroll.js'
// import gallery from '@core/mod/gallery/gallery.js'
// import scrollbar from '@core/mod/scrollbar/scrollbar.js'
// import hook from '@core/mod/hook.js'
// import masonry from '@core/mod/masonry/masonry.js'
// import modal from '@core/mod/modal/modal.js'
// import accordion from '@core/mod/accordion/accordion.js'
import dropdown from '@core/mod/dropdown/dropdown.js' 
// import sticky from '@core/mod/sticky/sticky.js'
// import tree from '@core/mod/tree/tree.js' 

var App = new app()
window.App = App

// App.use(star)
// App.use(Overlay)
App.use(loader)
App.use(Drawer)
// App.use(mdForm)
App.use(dropdown)
// App.use(scroll)
// App.use(notice)
// App.use(gallery)
// App.use(scrollbar)
// App.use(masonry)
// App.use(accordion)
// App.use(sticky)
// App.use(tree)

// App.use(hook)
// App.use(modal)
App.use(custom)

// import '@core/views/views.js'

App.init()

// import Vue from 'vue';
// import Example from './vue/Example'

/* eslint-disable */
// new Vue({
// 	el:
// 		'#app',
// 	components: {
// 		Example,
// 	},
// })
