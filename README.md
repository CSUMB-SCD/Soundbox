# Soundbox

SoundsBox is a web application that helps the user identify music with a short music sample utilizing the device's microphone. <br/>
The user will provide SoundBox with a small 5 second sample of music of their choice. <br/>
SoundBox will then display the songs' artist, title and a list of recommended artist. <br/>

## Link to web application

https://evening-peak-63595.herokuapp.com/src/index.php


## How to run

1. Click on the link provided above.<br/>
2. You will then be greeted with the homepage.<br/>
3. Play a song.<br/>
4. Press 'Detect song'.<br/>
5. It will record the song being played for 5 seconds.<br/>
6. It will take 1-5 seconds to display the information of the song.<br/>
7. If you wish to detect another song just start on step 3 again.



## CircleCI 

https://circleci.com/gh/CSUMB-SCD/Soundbox

CircleCI was difficult to setup since it had its own PHPUnit. After reading through the documentation
I was able to override the CircleCi PHPUnit and make it run our version of PHPUnit. Once PHPUnit was
downloaded to the root directory we were able to run the PHPUnit command. We also included a PHPUnit.XML
that contains instructions for PHPUnit. The XML file includes the directory were all php test files are
located. Also, the XML file instructs PHPUnit to run all tests inside the tests folder. 

## Lessons Learned

The lessons learned from this project is to always deploy as soon as possible. 
Our project would always work with C9 but as soon as we would deploy on C9, nothing would work. 
Since we are using Heroku under a free plan, there are a lot of limitations. 
For example, we had to cut down the time the user can upload the music sample.
Heroku limits the megabytes allowed to upload, but it does not throw an error.
Communication is always a great feature to have in a team. 
The more you communicate, the smoother the project will come together. 
We stumbled through a lot of obstacles, but thanks to our communication we were able to overcome them. 

We also learned how to scope our project. 
Initially, our project included a couple extra features. 
One of which was to allow the user to upload an mp3 and then they would receive an edited mp3 file with the correct name and title of the file provided. 
This particular feature was removed due to limitations from Heroku. 
With Heroku, we have a certain limit of size file that may be uploaded. 
After speaking with Utsab, he recommended we scope down our vision. 
Which we slowly began doing so and the project began to come together nicely.
We were able to combine three API's (ACRCloud, YouTube DL, and Spotify) to create a nice web application.

## Troubleshooting

- If the song information does not appear after 10 seconds of recording the audio, increase the volume of the music or put the sounds of the music closer to the microphone.

## Developers

<!-- ALL-CONTRIBUTORS-LIST:START -->


[<img src="https://avatars0.githubusercontent.com/u/15005274?s=400&v=4" width="100px;"/><br /><sub>@dariomolina93</sub>](https://github.com/dariomolina93) 

[<img src="https://avatars2.githubusercontent.com/u/14968874?s=400&v=4" width="100px;"/><br /><sub>@MarioMartinezA</sub>](https://github.com/MarioMartinezA)

[<img src="https://octodex.github.com/images/codercat.jpg" width="100px;"/><br /><sub>@DiegoAMedina</sub>](https://github.com/DiegoAMedina)

<!-- ALL-CONTRIBUTORS-LIST:END -->
