<?php

$menu = array (
				array (
						'url' => '/index.htm',
						'text' => 'Home',
						'class' => 'home'
						),

				array (
						'url' => '/services.htm',
						'text' => 'Services',
						'class' => 'services'
						),

				array (
						'url' => '/css.htm',
						'text' => 'CSS Design',
						'class' => 'css'
						),
				array (
						'url' => '/accessibility.htm',
						'text' => 'Accessibility',
						'class' => 'accessibility',
						'subMenu' => array (
											array (
													'url' => '/accessibility-training.htm',
													'text' => 'Accessibility Training',
													),
											array (
													'url' => '/accessibility-aaa.htm',
													'text' => 'AAA Myth',
													),
											)
				         ),
				array (
						'url' => '/usability.htm',
						'text' => 'Usability',
						'class' => 'usability'
						),
				array (
						'url' => '/compliance.htm',
						'text' => 'Compliance',
						'class' => 'compliance'
						),
				array (
						'url' => '/case-studies.htm',
						'text' => 'Case Studies',
						'class' => 'caseStudies'
							  ),
				array (
						'url' => '/about-us.htm',
						'text' => 'About Us',
						'class' => 'aboutUs',
						'subMenu' => array (
											array (
													'url' => '/expertise.htm',
													'text' => 'Expertise',
													),
											array (
													'url' => '/team.htm',
													'text' => 'The Team',
													'subMenu' => array (
																		array (
																				'url' => '/phil.htm',
																				'text' => 'Phil'
																 					),
																		array (
																				'url' => '/ben.htm',
																				'text' => 'Ben'
																				),
																		array (
																				'url' => '/luke.htm',
																				'text' => 'Luke'
																					)
																	  	)
													)
											)

						),
				array (
						'url' => '/news.htm',
						'text' => 'News',
						'class' => 'news'
						),
				array (
						'url' => '/articles.htm',
						'text' => 'Articles',
						'class' => 'news',
						'subMenu' => array (
											array (
													'url' => '/php-menu.htm',
													'text' => 'PHP Navigation Menu',
													),
											array (
													'url' => '/accessibility-aaa.htm',
													'text' => 'AAA Myth',
													)
											)
						),
				array (
						'url' => '/site-map.htm',
						'text' => 'Site Map',
						'class' => 'siteMap'
						),
				array (
						'url' => '/contact-us.htm',
						'text' => 'Contact Us',
						'class' => 'contactUs'
						)

			);

function is_assoc(array $array){
  return (bool)count(array_filter(array_keys($array), 'is_string'));
}

?>
