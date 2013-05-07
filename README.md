# Breadcrumbs

Extension for Kohana that renders HTML with added crumbs. 

## Installation

If your application is a Git repository:

    git submodule add git@github.com:seyfer/breadcrumbs.git modules/breadcrumbs
    git submodule update --init

Or clone the module separately:

    cd modules
    git clone git@github.com:seyfer/breadcrumbs.git modules/breadcrumbs

### Configuration

Edit `application/config/breadcrumbs.php` for custom configuration.

## Usage

Placed in a controller action:

   	//place in your base controller in after() method
	Breadcrumbs::generate_from_request($this->request); 

	//you can also add own crumbs
	Breadcrumbs::add(array($this->template->page_title, $this->request->url()));

	//than you can render HTML and use it in template
	$crumbs                 = Breadcrumbs::render();
        $this->template->crumbs = $crumbs;

You can use i18n for generated from url crumbs translation. 
    

