<script type="text/javascript">
	function filter_tag(a){
		a = a.replaceAll('+', ' +');
		a = a.replaceAll('&', '&amp;');
		a = a.replaceAll('#', 'hashtag');
		a = a.replaceAll('\t', '');
		a = a.replaceAll('\n', '');
		a = a.replaceAll("'", '`');
		a = a.replaceAll('<', '< ');
		a = a.replaceAll('/>', ' />');
		a = a.replaceAll('</', '</ ');
		a = a.replaceAll('>', ' >');
		a = a.replaceAll('.', '. ');
		a = a.replaceAll(',', ', ');
		a = a.replaceAll('. .', '..');
		a = a.replaceAll('. .', '..');
		a = a.replaceAll('  ', ' ');
		a = a.replaceAll('  ', ' ');
		a = a.replaceAll('......', '...');
		a = a.replaceAll('.....', '...');
		a = a.replaceAll('....', '...');
		a = a.replaceAll('...', '...');
		a = a.replaceAll('------', '--');
		a = a.replaceAll('-----', '--');
		a = a.replaceAll('----', '--');
		a = a.replaceAll('---', '--');
		a = a.replaceAll('______', '__');
		a = a.replaceAll('_____', '__');
		a = a.replaceAll('____', '__');
		a = a.replaceAll('___', '__');
		return a;
	}
</script>