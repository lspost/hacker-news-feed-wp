import {TextControl} from '@wordpress/components';

const HNF_ICON = (
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0h-13Zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5ZM12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0Zm2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0ZM1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1ZM1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25Z" />
  </svg>);

wp.blocks.registerBlockType("hackernewsfeed/newsfeed", {
  title: "Hacker News Feed",
  icon: HNF_ICON,
  category: "common",
  attributes: {
    testProp: {type: "string"}
  },
  edit: EditComponent,
  save: () => {
    return null;
  }
});

function EditComponent(props) {
  function updateTestProp(value) {
    props.setAttributes({testProp: value});
  }

  return (
    <div>
      <TextControl label="Name" value={props.attributes.testProp} onChange={updateTestProp} />
    </div>
  );
}