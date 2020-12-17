function requireAll(require) {
	require.keys().forEach(require)
}
requireAll(require.context('./views/', true, /\.twig$/))
