<!DOCTYPE html>
 
<html>
       <head>
       <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
       <script>
					var post = angular.module('PostApp', []);

					post.controller('PostController', function() {
								 var pc = this;
								 pc.post_list = ['Hello World', 'Testing'];  //Class variable
								 pc.addPost = function(){
												pc.post_list.push(pc.post_text)
												pc.post_text = ""
								 };
					});
			 </script>
       </head>
 
       <body>
       <div ng-app="PostApp">
              <div ng-controller="PostController as pc">              
              <form ng-submit="pc.addPost()">
                     <input type="text" ng-model="pc.post_text"  size="30"
                    placeholder="New post...">
                     <input class="btn-primary" type="submit" value="add">
              </form>
              <p> Total posts: {{ pc.post_list.length }} </p>
              <li class="animated flash" ng-repeat="post in pc.post_list">
                     <p>{{ post }}</p>
              </li>
              </div>
       </div>
       </body>
 
</html>