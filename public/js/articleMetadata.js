 var $ = $ || function(){};
 var console = console || function(){};
 $(function(){
  "use strict";
  var i=0;
  var $metadataHolder = $('#article_metadatas');
  /** @var metadataForm String **/
  var metadataForm = $metadataHolder.data('prototype').replace("__name__label__","");
  var $addMetadataButton = $("<a>",{id:'addMetadataButton',text:'Add a new metadata',"class":'btn btn-small'});

  $metadataHolder.prepend('<hr>').prepend($addMetadataButton);
  var addMetadata = function(event){
    var $newMetadataForm = $(metadataForm.replace(/__name__/g,++i));
    changeMetadataFormAppearance($newMetadataForm);
    $metadataHolder.append($newMetadataForm);
    return false;
  };
  var changeMetadataFormAppearance = function(jQueryObject){
    var $removeMetadataButton = $("<button type='button' class='btn removeMetadataForm'><i class='icon-minus'></i></button>") ;
    jQueryObject.addClass('form-inline');
    jQueryObject.find("div").css({display:'inline'});
    jQueryObject.append($removeMetadataButton);
    $removeMetadataButton.on('click',function(e){
      console.log('click');
      jQueryObject.remove();
    });
    jQueryObject.append();
    jQueryObject.append($('<hr>'));
  };
  var main=function(){
   $addMetadataButton.on('click',addMetadata);
 };
 main();
});