window.onload = function () {
	
	// 循环删除页面加载时css过度动画的效果抑制
	const elementsTranslationPreload = document.getElementsByClassName("translation-preload");
	while (elementsTranslationPreload.length > 0) {
		// console.debug("Removing translation-preload tag on element" + elementsTranslationPreload[0].nodeName + "#" + elementsTranslationPreload[0].id);
		// console.debug("Last elements count is : " + elementsTranslationPreload.length);
		elementsTranslationPreload[0].classList.remove("translation-preload");
	}
	console.debug("translation-preload tag remove done");
	
}