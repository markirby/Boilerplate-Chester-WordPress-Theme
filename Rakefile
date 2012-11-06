desc 'Compile SCSS'
task :compile_scss do 
    current_location = File.dirname(__FILE__)
    sh "compass compile --sass-dir #{current_location}/sass-css --css-dir #{current_location}/css -I #{current_location}/sass -e production"
end

desc 'Watch SCSS'
task :watch_scss do 
    current_location = File.dirname(__FILE__)
    sh "compass watch --sass-dir #{current_location}/sass-css --css-dir #{current_location}/css -I #{current_location}/sass -e production"
end