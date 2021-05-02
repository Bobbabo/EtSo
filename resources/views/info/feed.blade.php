<center>
    <div class="infoButton" data-toggle="modal" data-target="#infoFeedModal">
        i
    </div>
    <h6><strong>Click the information button above to read more!</strong></h6>
</center>


<div class="modal fade" id="infoFeedModal" tabindex="-1" role="dialog" aria-labelledby="infoFeedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoFeedModalLabel">About the feed</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>
              Your feed consist of all posts made by the people that you are following. <br><br>
              The feed is sorted in a reverse chronological order, meaning that the most recent posts will be at the top. <br>
              This implementation is more ethical than an engagement driven algorithm, but it is not optimal for user experience.<br>
              In the future, the feed will use an algorithm that is based on showing the content that is most useful for the user first.
              <br><br>
              <strong>
                Find users to follow by using the search bar in the top left corner of the page.
              </strong>
              <br><br>
              You can create a post by clicking the "CREATE A POST" button. <br>
              This will allow you to choose an optional description and image, as well as specifying whether your post 
              is a social post, or a post intended to be informative. <br>
              A social post has a like button that can only be viewed when the user has interacted with the post. 
              The reason for this is to avoid the effect of social bias.
              <br><br>
              A news post has a different rating system, where a user can rate whether they found the information to be 
              reliable or not. In the future, this information will be used to label the trustworthiness of a specific post.<br>
              Another implementation for the future is to make use of fact checking services that can generate information 
              warnings on posts. For example, a disclaimer stating that an article is using a clickbait headline. 

          </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Understood!</button>
        </div>
      </div>
    </div>
  </div>