$(function(){$(".chips").chips(),$(".chips-initial").chips({data:[{tag:"Apple"},{tag:"Microsoft"},{tag:"Google"}]}),$(".chips-placeholder").chips({placeholder:"Enter a tag",secondaryPlaceholder:"+Tag"}),$(".chips-autocomplete").chips({autocompleteOptions:{data:{Apple:null,Microsoft:null,Google:null},limit:1/0,minLength:1}})});
