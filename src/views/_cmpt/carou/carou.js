import "./carou.scss";
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel/dist/assets/owl.theme.default.css";
import "owl.carousel";

var gee = gee || $.fn.gene;
gee.hook("carou.init", me => {
	var ta = me.data("ta") ? $(me.data("ta")) : me;

	ta.addClass("carousel carousel-container owl-carousel ");

	// var items = me.data('items') || 1
	var props = me.data();

	props.lazyLoad = me.data("lazy");

	var config = {
		autoplay: false,
		autoplayTimeout: 4000,
		autoplayHoverPause: false,
		loop: true,
		nav: true,
		lazyLoad: true,
		margin: 0,
		navText: [
			"<i class='icon icon-angle-left'></i>",
			"<i class='icon icon-angle-right'></i>"
		],
		dots: true,
		items: 1,
		autoHeight: false,
		callbacks: true
	};

	Object.keys(props).forEach(function(k) {
		if (!config.hasOwnProperty(k)) return;
		config[k] = props[k];
	});
	// ta.on('initialize.owl.carousel', function(event) {
	// 	console.log(event)
	// })
	ta.on("initialized.owl.carousel", function(event) {
		ta.removeClass("loading");
	});
	ta.owlCarousel(config);
});
