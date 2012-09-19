 var $ = $ || function(){};
 var console = console || function(){};
 $(function(){
  "use strict";
  var i=0;
  var $metadataHolder = $('#article_metadatas');
  /** @var metadataForm String **/
  var metadataForm = $metadataHolder.data('prototype').replace("__name__label__","").replace("","");
  var $addMetadataButton = $("<a>",{id:'addMetadataButton',text:'Add a new metadata',"class":'btn btn-small'});

  $metadataHolder.prepend('<hr>').prepend($addMetadataButton);
  var addMetadata = function(event){
    var $newMetadataForm = $(metadataForm.replace(/__name__/g,$metadataHolder.children('div').length));
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
  var initMetadataHolder=function($metadataHolder){
    $metadataHolder.children("div").each(function(index,object){
      changeMetadataFormAppearance($(object));
    });
    //i = ++$metadataHolder.children("div").length;
  };
  var main=function(){
    initMetadataHolder($metadataHolder);
    $addMetadataButton.on('click',addMetadata);
 };
 main();
});