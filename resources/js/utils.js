/** Utilities function **/
var current;
var accounts = [];

/** Convert string to title case **/
function toTitleCase(toTransform) {
  return toTransform.replace(/\b([a-z])/g, function (_, initial) {
      return initial.toUpperCase();
  });
}

/** Get document element of frame **/
function getDocumentOfFrame(frame)
{
	if(frame.document !== undefined){
		return frame.document;
	}
	else
	{
		return frame.contentDocument;
	}
}
